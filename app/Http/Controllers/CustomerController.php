<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function postForm()
    {
        return view('posting', ['page_name' => 'Post to Deliver']);
    }

    public function postSubmit(Request $request, Order $order)
    {
        $data = $request->input();
        unset($data['_token']);
        $data['customer_id']  = auth()->user()->id;
        $data['created_at']   = Carbon::now();
        $data['date_ordered'] = Carbon::now();
        $order->newQuery()->insert($data);

        return redirect('posting')->with('success', 'Order has been posted!');
    }

    public function myOrders()
    {
        return view('orders', ['page_name' => 'My Orders']);
    }

    public function fetchOrders()
    {
        return Order::query()->where('customer_id', auth()->user()->id)
                             ->orderBy('created_at', 'desc')
                             ->get();
    }
}
