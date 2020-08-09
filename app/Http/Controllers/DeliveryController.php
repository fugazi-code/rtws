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

    public function store(Request $request)
    {

    }

    public function fetch()
    {
        return [
            'pending' => Booking::query()->where('status', 'pending')->with(['customer', 'photo'])->get(),
            'yours'   => Booking::query()->where('status', 'accepted')->where('rider_id', auth()->id())->with([
                'rider',
                'photo',
            ])->get(),
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
}
