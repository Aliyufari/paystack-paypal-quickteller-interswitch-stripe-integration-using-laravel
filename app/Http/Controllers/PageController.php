<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function stripe()
    {
        return view('stripe');
    }

    public function paystack()
    {
        return view('paystack');
    }

    public function quickteller()
    {
        return view('quickteller');
    }
}
