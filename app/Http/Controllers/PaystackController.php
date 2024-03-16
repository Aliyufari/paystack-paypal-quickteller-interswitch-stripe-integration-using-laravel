<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaystackController extends Controller
{
    public function callback(Request $request)
    {
        $reference = $request->reference;
        $secret_key = config('paystack.paystack_sk');
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secret_key",
            "Cache-Control: no-cache",
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        $products =  $response->data->metadata->products;
        $customer =  $response->data->customer;

        // dd($customer);
        
        if ($response->data->status === "success") 
        {
            $payment = new Payment;

            $payment->transaction_id = $reference;
            $payment->product = $products[0]->name;
            $payment->quantity = count($products);
            $payment->amount = $response->data->amount;
            $payment->currency = $response->data->amount;
            $payment->customer_name = $customer->first_name." ".$customer->first_name;
            $payment->customer_email = $response->data->status === "success";
            $payment->method = "Paystack";
            $payment->status = $response->data->status;
            $payment->save(); 

            return redirect()->route('paystack.success');  
        }else {
            return redirect()->route('paystack.cancel');  
        }
    }

    public function success()
    {
        return "Payment Successful";
    }

    public function cancel()
    {
        return "Payment cancelled";
    }
}
