<?php

namespace App\Http\Controllers;

use App\TopUp;
use App\Wallet;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Wallet $wallet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Wallet $wallet)
    {
        if ($wallet->isExist()) {
            $wallet->rebuildWallet();
        }
        $current = $wallet->current();

        return view('auth.wallet', compact('current'));
    }

    public function formTopUp()
    {
        return view('auth.topup_form');
    }

    public function sendTopUp(Request $request, TopUp $topUp)
    {
        dd($request->input());
    }
}
