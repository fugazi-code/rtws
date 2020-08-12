<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\Transformers\BookingFetchTransformer;

class ManageDriverController extends Controller
{
    public function index()
    {
        return view('manage_driver', ['page_name' => 'Manage Driver']);
    }

    public function fetch()
    {
        $booking = Booking::with('customer')
                          ->where('customer_id', auth()->id())
                          ->orderByDesc('id')
                          ->get()
                          ->toArray();

        return [
            'booking' => fractal($booking, new BookingFetchTransformer()),
        ];
    }
}
