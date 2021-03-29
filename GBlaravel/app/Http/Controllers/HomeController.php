<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swap\Laravel\Facades;
use Swap\Laravel\Facades\Swap;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    //     $rate = Swap::latest('USD/RUB');
    //     dd(number_format($rate->getValue(), 2));
        return view('index');
    }
}
