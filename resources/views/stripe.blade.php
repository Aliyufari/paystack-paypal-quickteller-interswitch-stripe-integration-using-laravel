@extends('layouts.app')

@section('content')
<div style="display: flex; flex-direction:column; align-items:center; justify-content:center; padding: 80px 0">
    <h3>Product: Samsung Galaxy A9</h3>
    <h3>Price: $50</h3>
    <form action="" method="POST">
        @csrf
        <input type="hidden" name="product" value="Product: Samsung Galaxy A9">
        <input type="hidden" name="price" value="50">
        <input type="hidden" name="quantity" value="1">

        <button>Pay with Stripe</button>
    </form>
</div>
@endsection