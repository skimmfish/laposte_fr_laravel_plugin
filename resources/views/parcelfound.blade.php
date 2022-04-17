
@extends('layouts.app')
@section('content')


<!--main home page-->
<div class="row-fluid">

<div class="div-center padded_100" style="display:grid;grid-template-column:1;grid-gap:25px;justify-content:Center;margin:auto;">

{{-- $jsonObj, a json_encode of an array object converts the array into a string that could be presented in a 1-liner format --}}

<h4>Your parcel has been found.  </h4>

<div style="margin-bottom:50px;"><small class="small">To show more information, click on the button below to pay &#x20AC;2.</small></div>

<button type="button" class="btn btn-primary btn-tomato" data-toggle="modal" data-target="#exampleModal">Pay</button>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select payment method</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="paypal_modal">

<center><b class="text-center">How do you wish to pay? Please select an option</b></center>

<!--using paypal to make payment-->
<form method="POST" action="{{route('handle-payment')}}">
@csrf
<input value="EUR" name="currency"  type="hidden" />
<input value="2" name="amt"  type="hidden" />
<input value="{{ $trackingID }}" name="trackingID"  type="hidden" />
<input value="{{route('trackinginfo_page') }}"  name="notify_url" type="hidden" />
<input type="hidden" name="desc" value="Parcel Tracking Information Service"
<input value="{{ route('cancel-payment') }}"  name="cancel_url" type="hidden" /><Br/>
<input value="{{route('trackinginfo_page',['parcel_number'=>$trackingID]) }}"  name="return_url" type="hidden" /><Br/>
<button name="paypal_btn" class="btn btn-primary" style="display:block;margin:auto;width:90%" target="_blank">Paypal</button>
</form>

</div>
	</div>
	
	
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
		</div>
			</div>
				</div>
					</div>
<!--end of modal-->
							</div>
							</div>

@endsection