<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
