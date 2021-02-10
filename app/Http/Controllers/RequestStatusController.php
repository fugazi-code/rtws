<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Facade\Ignition\Tabs\Tab;
use App\Events\CustomerCancelEvent;
use App\Transformers\BookingFetchTransformer;
use DB;

class RequestStatusController extends Controller
{
    public function index()
    {
        return view('auth.request_status');
    }

    public function fetch(Request $request)
    {
        $booking = Booking::with('customer', 'rider')
                          ->where('customer_id', $request->id)
                          ->orderByDesc('id')
                          ->get()
                          ->toArray();

        return [
            'booking' => fractal($booking, new BookingFetchTransformer()),
        ];
    }

    public function cancel(Request $request)
    {
        Booking::find($request->book_id)->update(['status' => 'cancelled']);

        broadcast(new CustomerCancelEvent());

        session()->put('success', 'Book has been cancelled!');

        return redirect()->back();
    }

    public function details($id)
    {
        $results = DB::table('bookings')
                     ->selectRaw('bookings.*, uc.name as customer_name, ur.name as rider_name, g.path')
                     ->where('bookings.id', $id)
                     ->leftJoin('users as uc','uc.id', '=', 'customer_id')
                     ->leftJoin('users as ur','ur.id', '=', 'rider_id')
                     ->leftJoin('galleries as g','g.user_id', '=', 'rider_id')
                     ->get()[0];

        return view('auth.request_details', compact('results'));
    }
}
