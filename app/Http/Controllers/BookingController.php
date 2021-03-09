<?php

namespace App\Http\Controllers;

use App\Booking;
use Carbon\Carbon;
use Faker\Factory;
use App\PromoCode;
use App\CodeHistory;
use Illuminate\Http\Request;
use App\Matrix\Specifications;
use App\Events\NotifySoundEvent;
use App\Events\BookingSubmitEvent;
use App\Http\Requests\BookingSubmit;

class BookingController extends Controller
{
    public function index()
    {
        if (session()->exists('form')) {
            $form = session('form');
        } else {
            $form = [
                'vehicle'         => 'motorcycle',
                'service'         => 'padala',
                'weight'          => '0',
                'budget'          => '0',
                'schedule_pickup' => Carbon::now(),
                'dp'              => ['name' => '', 'lat' => '0', 'lng' => '0'],
                'pu'              => ['name' => '', 'lat' => '0', 'lng' => '0'],
                'kilometers'      => '',
                'setup'           => null,
                'amount'          => '0',
                'promocode'       => '',
            ];
        }

        return view('auth.book_now', ['form' => collect($form)]);
    }

    public function store(BookingSubmit $request)
    {
        $form = session()->get('form');
        $schedule = $request->get("schedule");

        if (! $schedule) {
            $schedule = Factory::create()->bankAccountNumber;
        }

        $booking = Booking::create([
            "status"        => "pending",
            "customer_id"   => auth()->id(),
            "vehicle"       => $request->get("vehicle"),
            "service"       => $request->get("service"),
            "sub"           => $request->get("sub"),
            "schedule"      => $request->get("schedule"),
            "pick_up"       => $form['pu']['name'],
            "drop_off"      => $form['dp']['name'],
            "amount"        => $request->get("amount"),
            "weight"        => $request->get("weight"),
            "budget"        => $request->get("budget"),
            "distance"      => $request->get("kilometers"),
            "exact_address" => json_encode(['dp' => $form['dp'], 'pu' => $form['pu']]),
            "ref_no"        => strtoupper(hash('adler32', $schedule)),
        ]);

        if ($request->promocode != '') {
            $promo_code_id = PromoCode::query()->where('code', $request->promocode)->first()->id;

            CodeHistory::query()->insert([
                'promo_code_id' => $promo_code_id,
                'booking_id'    => $booking->id,
                'customer_id'   => auth()->id(),
                'created_at'    => Carbon::now(),
            ]);
        }

        broadcast(new BookingSubmitEvent());
        broadcast(new NotifySoundEvent());

        session()->put('success', 'Book has been submitted!');
        session()->forget('form');
        return redirect()->back();
    }

    public function map(Request $request)
    {
        session(['form' => $request->input()]);

        return view('auth.map', ['form' => collect(session('form'))]);
    }

    public function locationStore(Request $request)
    {
        $form = session('form');

        if ($form['setup'] == 'dp') {
            $form['dp']['name'] = $request->name;
            $form['dp']['lat']  = $request->lat;
            $form['dp']['lng']  = $request->lng;
        } else {
            $form['pu']['name'] = $request->name;
            $form['pu']['lat']  = $request->lat;
            $form['pu']['lng']  = $request->lng;
        }

        $form['kilometers'] = round($request->kilometers);

        session()->forget('form');
        session(['form' => $form]);
    }

    public function matrix(Specifications $spec)
    {
        return $spec->initialize()->get();
    }
}
