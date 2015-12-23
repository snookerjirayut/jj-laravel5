@extends('welcome')
@section('title', 'Summary')
@section('content')
<style type="text/css">
	.lock-number{
		width: 90px;
		height: 90px;
		padding: 10px;
		padding-top: 25px;
		margin-top: 0;
		vertical-align: middle;
		border:1px solid #ccc;
		text-align: center;
	}
	.media-body{
		padding: 15px;
	}
	.row.buttom{
		margin-top: 30px;
	}
	.media{
		    padding-left: 10%;
	}
	.row.buttom.last{
		margin-top: 20px;
		margin-bottom: 50px;
	}
</style>
<div class="row">
<div class="col-sm-8 col-sm-offset-2">	
	<div class="row">
		<div class="col-sm-6 text-left">
			<p><strong>เช่าล๊อคของวันที่ : </strong> 
			{{   date("D j F Y", strtotime($booking->sale_at))  }} 
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 right">
			<p><strong>ชื่อสินค้า : </strong>{{ $booking->productName }} </p>
			<p><strong>ชื่อผู้จอง : </strong> {{ $user->name }}</p>
			<p><strong>ที่อยู่ : </strong>{{ $user->address }} </p>
		</div>
	</div>

@if($detail != null)
@foreach ($detail as $obj)
	<div class="media">
	  <div class="media-left">
	    <h2 class="lock-number">{{  $obj->zoneNumber }}</h2>
	  </div>
	  <div class="media-body">
	    <h4 class="media-heading">โซน {{ $detail->zoneName }}</h4>
	    ราคา {{ $obj->price }} บาท 
	    จำนวน 1 ล๊อค
	  </div>
	</div>
@endforeach

	<div class="row buttom">
		<div class="col-sm-6 text-left"><p><strong>จำนวนรวม : </strong>{{ count($detail) }} ล๊อค</p></div>
		<div class="col-sm-6 text-right"><p><strong>ราคารวม : </strong>{{ $booking->totalPrice }} บาท</p></div>
	</div>

	<div class="row buttom last">
		<div class="col-sm-6 col-sm-offset-3"><button class="btn btn-success btn-block" onclick="backToBooking()">กลับสู่หน้าจอง</button></div>
	</div>

</div>

@endif

</div>

@endsection


@section('script')
<script type="text/javascript">
	var backToBooking = function(){
		window.location = '/booking';
	}
</script>
@endsection