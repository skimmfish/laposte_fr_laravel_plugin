
@extends('layouts.app')
@section('content')


<!--main home page-->
<div class="row-fluid">
<div class="div-center padded_100" style="display:grid;grid-template-column:1;grid-gap:20px;justify-content:Center;margin:auto;">

<h6>Your parcel was not found, please try again </h6>
</div>
<div class="div-center sh_up" style="margin-top:-130px">
<form method="get" action="{{route('parcel_service_search') }}">
@csrf
<div class="row flex">
<div class="row flex"style="margin-top:-40px;">
<div class="col-md-6 col-xs-11 col-sm-7 col-lg-6"><input type="text" class="form-control input-lg input-text" style="border:1px solid #dfdfdf;" placeholder="Tracking Number" value="{{old('parcel_number') }}" name="parcel_number" autofocus required />
<div class="col-md-5 col-xs-11 col-sm-5 col-lg-1 pull-right"><button name="track" type="submit" class="btn btn-warning btn-tomato"><i class="fa fa-search"></i> Track</button></div>
</div>

</form>
</div>

</div>
</div>
@endsection