@extends('layouts.app')

@section('content')
<div style="display: flex; flex-direction:column; align-items:center; justify-content:center; padding: 80px 0">
    <h3>Product: Samsung Galaxy A9</h3>
    <h3>Price: N50, 000</h3>
    <form action="interswitch-pay" method="POST">
        @csrf
        <input type="hidden" name="customerEmail" value="johndoe@nomail.com" />
        <input type="hidden" name="amount" value="5000000" />
        <input type="hidden" name="transactionReference" value="{{ bin2hex(random_bytes(16)) }}">
        <!-- Amount must be in kobo-->
        <button
            type="submit"
            style="
                padding: 12px 22px;
                background-color: #c80e0e;
                border: none;
                color: #fff;
                font-size: 1em;
                border-radius: 5px;
            "
        >
            Pay Now
        </button>
    </form>
</div>
@endsection