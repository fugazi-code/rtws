<?php

namespace App\Http\Controllers;

use App\TopUp;
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
        $model = TopUp::with(['approver','requestor'])->selectRaw('top_ups.*');

        return DataTables::of($model)->make(true);
    }

    public function edit($id)
    {
        $topup = TopUp::find($id);

        return view('auth.topup_edit', compact('topup'));
    }

    public function update(Request $request, TopUp $topup)
    {
        $topup->updateStatus($request);

        return redirect()->route('topup.requests')->with('success', 'Top-Up update successful!');
    }
}
