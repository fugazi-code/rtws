<?php

namespace App\Http\Controllers;

use App\TopUp;
use App\Wallet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TopUpController extends Controller
{
    public function index()
    {
        return view('auth.topup_requests');
    }

    public function table()
    {
        $model = TopUp::with(['approver', 'requestor'])->selectRaw('top_ups.*');

        return DataTables::of($model)->make(true);
    }

    public function edit($id)
    {
        $topup = TopUp::find($id);

        return view('auth.topup_edit', compact('topup'));
    }

    public function update(Request $request, TopUp $topup, Wallet $wallet)
    {
        $requester = $topup->getRequester($request->id);
        $amount    = $topup->getAmount($request->id);

        if (($topup->isStatusApproved($request->id) && $request->status == 'approved')
            || ($topup->isStatusDenied($request->id) && $request->status == 'denied')) {
            return redirect()->route('topup.requests')->with('warning', 'Status is the same!');
        } elseif ($request->status == 'approved') {
            $wallet->deposit($requester, $amount);
        } elseif ($topup->isStatusApproved($request->id) && $request->status == 'denied') {
            $wallet->withdraw($requester, $amount);
        }

        $topup->updateStatus($request);

        session()->put('success', 'Top-Up update successful!');

        return redirect()->route('topup.requests');
    }
}
