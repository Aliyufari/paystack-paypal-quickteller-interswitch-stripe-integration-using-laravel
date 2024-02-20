<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Stripe Payment with Laravel</title>
    </head>
    <body style="display: flex; flex-direction:column; align-items:center; justify-content:center; padding: 80px 0">
        <h1>Stripe Payment</h1>
        <h3>Product: Samsung Galaxy A9</h3>
        <h3>Price: $50</h3>
        <form action="{{ route('stripe.pay') }}" method="POST">
            @csrf
            <input type="hidden" name="product" value="Samsung Galaxy A9">
            <input type="hidden" name="price" value="50">
            <input type="hidden" name="quantity" value="1">

            <button>Pay with Stripe</button>
        </form>
    </body>
</html>