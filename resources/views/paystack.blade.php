@extends('layouts.app')

@section('content')
<div style="display: flex; flex-direction:column; align-items:center; justify-content:center; padding: 80px 0">
    <h3>Product: iPhone 15</h3>
    <h3>Price: N50,000</h3>
    <form id="paymentForm">
        <div class="form-group">
            <label for="email">Email Address</label><br>
            <input type="email" id="email-address" value="aliyufari@gmail.com" required />
        </div>
        <br>
        <div class="form-submit">
            <button type="submit">Pay with Paystack</button>
        </div>
    </form>      
</div>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    function payWithPaystack(e) {
        e.preventDefault();
        let handler = PaystackPop.setup({
            key:  "{{ config('paystack.paystack_pk') }}",
            email: document.getElementById("email-address").value,
            amount: (50000 * 100),
            metadata: {
                products: [
                    {
                        name: "iPhone 15"
                    }
                ]
            },
            customer: [
                {first_name: "Aliyu"},
                {last_name: "Abubakar"}
            ],
            onClose: function(){
                window.location.href= "{{ route('paystack.cancel') }}";
            },
            callback: function(response){
                window.location.href= "{{ route('paystack.callback') }}" + response.redirecturl;
            }
        });
        handler.openIframe();
    }           
</script>
@endsection