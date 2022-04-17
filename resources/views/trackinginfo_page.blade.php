@extends('layouts.app')
@section('content')


<!--main home page-->
<div class="row-fluid">

<div class="div-center padded_100" style="display:grid;grid-template-column:1;grid-gap:25px;justify-content:Center;margin:auto;">

<h2 class="text-center">Your Parcel Tracking Information</h2>

<h4 class="text-danger text-center" style="text-transform:uppercase;">Parcel No: {{ $jsonBody['body']['shipment']['idShip'] }}</h4>
<b class="text-xs text-center">{{-- 'Entry Date:' date('d F Y, h:i:s A',strtotime($jsonBody['body']['shipment']['entryDate'])) --}}</b>
<b class="text-xs text-center">{{-- $jsonBody['body']['shipment']['timeline'][0]['date'] --}}</b>
<b class="text-xs text-center" style="color:#000;">

<?php foreach($jsonBody['body']['shipment']['event'] as $xr){ 
echo '<div class="grid-column text-left text-xs">-Le ' .date('d/m/Y',strtotime($xr['date'])).' : '.$xr['label'].' <b class="text-transform:uppercase">('.$xr['code'].')</b> </div>'; }?>
</b>

</div>
</div>

@endsection