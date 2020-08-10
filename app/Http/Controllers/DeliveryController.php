<?php

namespace App\Http\Controllers;

use App\Booking;
use League\Fractal;
use App\Transformers\DateTransformer;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('delivery', ['page_name' => 'Delivery']);
    }

    public function fetch(Booking $booking)
    {
        return [
            'pending'  => fractal($booking->pending()->get()->toArray(), new DateTransformer()),
            'yours'    => fractal($booking->yours()->get()->toArray(), new DateTransformer()),
            'complete' => fractal($booking->complete()->get()->toArray(), new DateTransformer()),
        ];
    }

    public function mine($id)
    {
        Booking::query()
               ->where('id', $id)
               ->update([
                   'status'   => 'accepted',
                   'rider_id' => auth()->id(),
               ]);

        return redirect()->back()->with('success', 'Request is yours now!');
    }

    public function complete($id)
    {
        Booking::query()
               ->where('id', $id)
               ->update([
                   'status'   => 'complete',
                   'rider_id' => auth()->id(),
               ]);

        return redirect()->back()->with('success', 'Request is yours now!');
    }
}
