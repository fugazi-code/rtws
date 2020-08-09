<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Book has been submitted!');
    }
}
