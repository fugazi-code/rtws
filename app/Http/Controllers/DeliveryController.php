<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('delivery', ['page_name' => 'Delivery']);
    }

    public function fetch()
    {
        return [
            'pending'  => Booking::query()
                                 ->where('status', 'pending')
                                 ->with(['customer', 'photo'])
                                 ->orderBy('created_at', 'desc')
                                 ->get(),
            'yours'    => Booking::query()
                                 ->where('status', 'accepted')
                                 ->where('rider_id', auth()->id())
                                 ->with(['rider', 'photo',])
                                 ->orderBy('created_at', 'desc')
                                 ->get(),
            'complete' => Booking::query()
                                 ->where('status', 'complete')
                                 ->where('rider_id', auth()->id())
                                 ->with(['rider', 'photo',])
                                 ->orderBy('created_at', 'desc')->get(),
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
