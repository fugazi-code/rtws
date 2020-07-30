<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function postedOrders()
    {
        return view('posted', ['page_name' => 'Posted Orders']);
    }

    public function fetchPosted()
    {
        return Order::with('customer')->get();
    }
}
