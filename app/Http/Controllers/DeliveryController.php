<?php

namespace App\Http\Controllers;

use App\Wallet;
use App\Booking;
use Carbon\Carbon;
use App\Commission;
use App\PubNub\PubNubConnect;
use App\Events\DeliveryChanges;
use App\Events\BookingStatusEvent;
use Illuminate\Http\Request;
use App\Transformers\DeliveryFetchTransformer;

class DeliveryController extends Controller
{
    /**
     * Inital page for deliver.
     *
     * @return mixed
     */
    public function index()
    {
        return view('auth.delivery');
    }

    /**
     * Gets data for Booking.
     *
     * @param \Illuminate\Http\Request $request
     * @param Booking $booking
     * @return array
     */
    public function fetch(Request $request, Booking $booking)
    {
        return [
            'pending'   => fractal($booking->pending()->get()->toArray(), new DeliveryFetchTransformer()),
            'yours'     => fractal($booking->yours($request->id)->get()->toArray(), new DeliveryFetchTransformer()),
            'complete'  => fractal($booking->complete($request->id)->get()->toArray(), new DeliveryFetchTransformer()),
            'cancelled' => fractal($booking->cancelled($request->id)->get()->toArray(), new DeliveryFetchTransformer()),
        ];
    }

    /**
     * Reserved a booking.
     *
     * @param $id
     * @param \App\Booking $booking
     * @return mixed
     */
    public function mine($id, Booking $booking)
    {
        if (! $booking->isAlreadyAccepted($id)) {
            $pubnub = new PubNubConnect();
            $pubnub->message("Reserved!");

            $booking->newQuery()->where('id', $id)->update([
                'status'     => 'accepted',
                'rider_id'   => auth()->id(),
                'updated_at' => Carbon::now(),
            ]);

            event(new BookingStatusEvent());

            return redirect()->back()->with('success', 'Request is yours now!');
        }

        return redirect()->back()->with('error', 'Booking has already been reserved!');
    }

    /**
     * Reserved a booking.
     *
     * @param $id
     * @param \App\Booking $booking
     * @return mixed
     */
    public function cancel($id, Booking $booking)
    {
        $booking->newQuery()->where('id', $id)->update([
            'status'   => 'cancelled',
            'rider_id' => auth()->id(),
        ]);

        event(new BookingStatusEvent());

        return redirect()->back()->with('error', 'Booking has been cancelled!');
    }

    /***
     * Completes a Booking.
     *
     * @param $id
     * @return mixed
     */
    public function complete($id, Booking $booking, Wallet $wallet, Commission $commission)
    {
        $booking = $booking->where('id', $id)->first();

        $comm = $booking->amount * .15;

        $wallet = $wallet->where('user_id', $booking->rider_id)->first();

        $commission->store($booking->id, $wallet->id, $booking->rider_id, $wallet->current, $comm);
        $wallet->withdraw($booking->rider_id, $comm);

        Booking::query()->where('id', $id)->update([
            'status'   => 'complete',
            'rider_id' => auth()->id(),
        ]);

        event(new BookingStatusEvent());

        return redirect()->back()->with('success', 'Request is yours now!');
    }
}
