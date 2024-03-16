<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Interswitch\Interswitch\Facades\Interswitch;

class QuickTellerController extends Controller
{
    public function pay(Request $request)
    {
        Interswitch::confirmTransaction($request->transactionReference, $request->amount);
    }

    public function success(Request $request)
    {
        return "Payment Successful";
    }
}
