<?php

namespace App\Http\Controllers;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\PubNub\PubNubConnect;
use App\Matrix\Specifications;

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
            ];
        }

        return view('booking', ['page_name' => 'Book Now', 'form' => collect($form)]);
    }

    public function store(Request $request)
    {
        session()->forget('form');
        $pubnub = new PubNubConnect();
        $pubnub->message("New Book!");

        Booking::create([
            "status"      => "pending",
            "customer_id" => auth()->id(),
            "vehicle"     => $request->get("vehicle"),
            "service"     => $request->get("service"),
            "sub"         => $request->get("sub"),
            "schedule"    => $request->get("schedule"),
            "pick_up"     => $request->get("pick_up"),
            "drop_off"    => $request->get("drop_off"),
            "amount"      => $request->get("amount"),
            "weight"      => $request->get("weight"),
            "budget"      => $request->get("budget"),
            "ref_no"      => hash('adler32', $request->get("schedule")),
        ]);

        return redirect()->back()->with('success', 'Book has been submitted!');
    }

    public function map(Request $request)
    {
        session(['form' => $request->input()]);

        return view('map', ['form' => collect(session('form'))]);
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
