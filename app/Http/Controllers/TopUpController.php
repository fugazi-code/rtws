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
}
