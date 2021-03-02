<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewRegistration;
use App\Http\Requests\AccountStoreRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Eto method na ito. Nirerequire ka niya na nakalogin
        // comment lang para hindi mabasa
        //$this->middleware('auth');
    }

    /**
     * Name sa loob ng view func ay galing sa homepage.blade.php
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('homepage');
    }

    public function riderFormReg()
    {
        return view('register_rider');
    }

    public function riderFormSubmit(AccountStoreRequest $request, User $user, Gallery $gallery)
    {
        $data = $request->input();
        unset($data['_token']);
        $data['role']       = "rider";
        $data['status']     = "for verification";
        $data['password']   = Hash::make('password');
        $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
        $id                 = $user->newQuery()->insertGetId($data);

        User::find($id)->notify(new NewRegistration());

        foreach ($request->file() as $key => $file) {
            $path = $file->store('details');
            $gallery->newQuery()->insert([
                'user_id' => $id,
                'path'    => $path,
                'purpose' => $key,
            ]);
        }

        session()->put('success', 'New User has been added!');

        return redirect('accounts');
    }
}
