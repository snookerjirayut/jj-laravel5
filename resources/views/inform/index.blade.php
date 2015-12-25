@extends('welcome')
@section('title', 'Inform')
@section('content')
<h3 class="text-center">ยืนยันการชำระเงินด้วยหลักฐานการโอน</h3>
<div class="col-sm-6 col-sm-offset-3">
	

	<div class="box-inform-upload">
		
		<img src="/img/icon-upload.png" class="img-responsive">

	</div>


	<button class="btn btn-block btn-success btn-upload">Upload</button>

</div>



@endsection
@section('script')
<script type="text/javascript">
	$('#nav-bar li').eq(2).addClass('active');

</script>

@endsection