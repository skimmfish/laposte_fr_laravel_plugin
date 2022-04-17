@extends('layouts.app')
@section('content')


<!--main home page-->
<div class="row">

<div class="div-center">
<?php if(isset($msg)){
echo "<div class='alert alert-warning'>$msg </div>";
}?>

<h2 class="padded_80 text-center" style="text-align:center !important;">E-Commerce Package Tracking Solution</h2>

<form method="GET" action="{{route('parcel_service_search') }}">
@csrf

<div class="row grid_x"style="margin:-40px auto 45px auto;">
<div class="text col-md-10"><input type="text" class="form-control input-lg input-text" placeholder="Tracking Number" value="{{old('parcel_number') }}" name="parcel_number" required />
<div class="bt col-md-2 pull-right">
<button name="track" type="submit" class="btn btn-warning btn-tomato"><i class="fa fa-search"></i> Track</button></div>
</div>


</form>
</div>

</div>
</div>



@endsection