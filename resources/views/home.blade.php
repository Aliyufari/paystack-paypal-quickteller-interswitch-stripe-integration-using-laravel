@extends('layouts.app')

@section('content')
    <div style="display: flex; flex-direction:column; align-items:center; justify-content:center; padding: 80px 0">
        <a href="{{ route('stripe') }}"><h2>Stripe Payment</h2></a>
        <a href="{{ route('paystack') }}"><h2>Paystack Payment</h2></a>
        <a href="{{ route('quickteller') }}"><h2>QuickTeller InterSwitch Payment</h2></a>
    </div>
@endsection