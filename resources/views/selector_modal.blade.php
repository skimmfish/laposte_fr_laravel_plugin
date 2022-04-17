<div class="paypal_modal">

<b class="text-center">How do you wish to pay? Please select an option</b>

<!--using paypal to make payment-->
<form method="POST" action="https://sandbox.paypal.com">
<input value="{{$amount}}" name="amt"  type="hidden" />
<input value=""  name="notify_url" type="hidden" />
<input value=""  name="cancel_url" type="hidden" />
<button name="paypal_btn" class="btn btn-primary" target="_blank">Paypal</button></form>

<!--using stripe to make payment-->
<a href="" class="btn btn-tomato" target="_blank">Stripe</a>

</div>