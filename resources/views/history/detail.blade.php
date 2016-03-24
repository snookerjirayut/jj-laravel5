@extends('welcome')
@section('title', 'History')
@section('breadcrumbs')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-4">
					<h1>ประวัติการจอง</h1>
				</div>
				<div class="col-lg-8 col-sm-8">
					<ol class="breadcrumb pull-right">
						<li><a href="{{ url('/') }}">หน้าหลัก</a></li>
						<li class="active">ประวัติการจอง</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
<div ng-controller="HistoryController" class="row" ng-init="init()" style="margin-bottom: 5%">
	
	<div class="row">
		<table class="table table-bordered">
			<tr style="font-weight: bold;">
				<td class="text-center">ลำดับ</td>
				<td class="text-center">รหัสการจอง</td>
				<td class="text-center">เลขที่</td>
				<td class="text-center">จำนวน</td>
				<td class="text-center">ราคา</td>
				<td class="text-center">จอง ณ วันที่</td>
				<td class="text-center">ขาย ณ วันที่</td>
			</tr>
			@if(isset($data))
			@foreach($data as $detail)
			<tr>
				<td class="text-center">{{ $detail->id }}</td>
				<td class="text-center">{{ $detail->code }}</td>
				<td class="text-center">{{ $detail->zoneNumber }}</td>
				<td class="text-center">1</td>
				<td class="text-right">{{ $detail->price }}</td>
				<td class="text-center">{{ $detail->created_at }}</td>
				<td class="text-center">{{ $detail->sale_at }}</td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>



</div>



@endsection

@section('script')
<script type="text/javascript">
	angular.module("myApp").controller('HistoryController', ['$scope' ,'$http' , function($scope , $http){ 

		$scope.list = {};
		$scope.list.bookings = [];

		$scope.input = {}; 
		$scope.input.total = 0;
		$scope.input.page = 1;
		$scope.input.pageSize = 10;

		


	}]);


</script>
@endsection