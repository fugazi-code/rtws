<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\PubNub\PubNubConnect;

class BookingController extends Controller
{
    public function index()
    {
        if (session()->exists('form')) {
            $form = session('form');
            session()->forget('form');
        } else {
            $form = [
                'service'         => 'padala',
                'vehicle'         => 'motorcycle',
                'sub'             => '',
                'schedule_pickup' => '',
                'dp'              => '',
                'pu'              => '',
                'kilometers'      => '',
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
            "ref_no"      => hash('adler32', $request->get("schedule")),
        ]);

        return redirect()->back()->with('success', 'Book has been submitted!');
    }

    public function map(Request $request)
    {
        session(['form' => $request->input()]);

        return view('map', ['page_name' => 'Booking']);
    }

    public function locationStore(Request $request)
    {
        $location = $request->input();
        $form     = session('form');
        $form['dp'] = $location['toLatLng'];
        $form['pu'] = $location['fromLatLng'];
        $form['kilometers'] = $location['kilometers'];

        session()->forget('form');
        session(['form' => $form]);
    }
}
