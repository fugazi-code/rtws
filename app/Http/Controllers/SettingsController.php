<?php

namespace App\Http\Controllers;

use App\settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings', ['page_name' => 'Settings']);
    }

    public function settings(Request $request)
    {
        Settings::create([
            "id"           => auth()->id(),
            "payment_type" => $request->get("payment_type"),
        ]);

        session()->put('success', 'Payment options has been updated!');

        return redirect()->back();
    }
}



