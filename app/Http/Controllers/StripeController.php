<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function pay(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
        'line_items' => [
            [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' =>  $request->product],
                'unit_amount' => $request->price * 100,
            ],
            'quantity' => $request->quantity,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('stripe.cancel'),
        ]);

        if (isset($response->id) && !empty($response->id)) {
            session()->put('product', $request->product);
            session()->put('price', $request->price);
            session()->put('quantity', $request->quantity);
            return redirect($response->url);
        }else{
            return redirect(route('stripe.cancel'));
        }
    }

    public function success(Request $request)
    {
        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $payment = new Payment();
            $payment->transaction_id = $response->id; 
            $payment->product = session()->get('product'); 
            $payment->amount = session()->get('price'); 
            $payment->quantity = session()->get('quantity'); 
            $payment->currency = $response->currency; 
            $payment->customer_name = $response->customer_details->name; 
            $payment->customer_email = $response->customer_details->email; 
            $payment->method = "Stripe"; 
            $payment->status = $response->status; 
            $payment->save();
            
            return "Payment success";

            session()->get('product');
            session()->get('price');
            session()->get('quantity');
        }else{
            return redirect(route('stripe.cancel'));
        }
    }

    public function cancel()
    {
        return "Payment cancelled";
    }
}
