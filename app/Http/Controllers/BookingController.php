<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\PubNub\PubNubConnect;
use App\Callbacks\DeliveryCallback;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking', ['page_name' => 'Book Now']);
    }

    public function store(Request $request)
    {
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
        ]);


        $pubnub = new PubNubConnect('pubnub_onboarding_channel');
        $pubnub->setListener(new DeliveryCallback());
        $pubnub->message("New Book!");

        return redirect()->back()->with('success', 'Book has been submitted!');
    }
}
