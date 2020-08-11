<?php

namespace App\Http\Controllers;

use App\Booking;
use App\PubNub\PubNubConnect;
use App\Events\DeliveryChanges;
use App\Callbacks\DeliveryCallback;
use App\Transformers\DeliveryFetchTransformer;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('delivery', ['page_name' => 'Delivery']);
    }

    public function fetch(Booking $booking)
    {
        return [
            'pending'  => fractal($booking->pending()->get()->toArray(), new DeliveryFetchTransformer()),
            'yours'    => fractal($booking->yours()->get()->toArray(), new DeliveryFetchTransformer()),
            'complete' => fractal($booking->complete()->get()->toArray(), new DeliveryFetchTransformer()),
        ];
    }

    public function mine($id)
    {
        $pubnub = new PubNubConnect();
        $pubnub->message("Reserved!");

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
        $pubnub = new PubNubConnect();
        $pubnub->message("Delivered!");

        Booking::query()
               ->where('id', $id)
               ->update([
                   'status'   => 'complete',
                   'rider_id' => auth()->id(),
               ]);

        return redirect()->back()->with('success', 'Request is yours now!');
    }
}
