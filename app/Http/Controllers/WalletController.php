<?php

namespace App\Http\Controllers;

use App\User;
use App\TopUp;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Notifications\TopUpRequest;
use Illuminate\Support\Facades\Notification;

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

    public function sendTopUp(Request $request, TopUp $topUp, Wallet $wallet)
    {
        $path      = $request->file('receipt')->store('receipt');
        $wallet_id = $wallet->id();

        $topUp->send($request, $path, $wallet_id);

        Notification::route('mail', User::query()->whereIn('role', ['admin', 'superadmin'])->pluck('email'))
                    ->notify(new TopUpRequest(auth()->user()->name));

        return redirect('wallet')->with('success', 'Your Top-Up request has been sent!');
    }

    public function table()
    {
        $model = TopUp::with(['approver'])->where('request_by', auth()->user()->id)->selectRaw('top_ups.*');

        return DataTables::of($model)
                         ->setTransformer(function ($value) {
                             $hold               = $value->toArray();
                             $hold['created_at'] = Carbon::parse($value->created_at)->format('F j, Y');

                             return $hold;
                         })
                         ->make(true);
    }
}
