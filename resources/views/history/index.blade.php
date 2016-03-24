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
				<td class="text-center">วันที่ขาย</td>
				<td class="text-center">จำนวน</td>
				<td class="text-center">ราคา</td>
				<td class="text-center">ประเภทการชำระเงิน</td>
				<td class="text-center">สถานะการชำระเงิน</td>
				<td></td>
			</tr>
			<tr ng-repeat="obj in list.bookings">
				<td class="text-center"><% obj.id %></td>
				<td class="text-center"><% obj.code %></td>
				<td class="text-center"><% obj.miliseconds | date:'EEEE dd MMMM yyyy' %></td>
				<td class="text-center"><% obj.quantity %></td>
				<td class="text-right"><% obj.totalPrice | number %></td>
				<td class="text-center">
					<div ng-if="obj.type == 1">โอนเงิน</div>
					<div ng-if="obj.type == 2">จ่าย ณ วันขาย</div>
				</td>
				<td class="text-center">
					<div ng-if="obj.payment == 0"><span class="label label-info">รอชำระเงิน</span></div>
					<div ng-if="obj.payment == 1"><span class="label label-warning">รอการอนุมัติ</span></div>
					<div ng-if="obj.payment == 2"><span class="label label-success">อนุมัติแล้ว</span></div>
				</td>
				<td class="text-center"><a href="/history/detail/<% obj.id %>" target="_blank"><i class="glyphicon glyphicon-search"></i></a></td>
			</tr>
		</table>
	</div>

	<div class="row">
	  	<div class="col-sm-12">
			<uib-pagination total-items="input.total" ng-model="input.page" items-per-page="input.pageSize" ng-change="nextPage()"></uib-pagination>
			<p>จำนวนแถว : <% input.total %></p>
		</div>
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

		$scope.init = function(){
			$http.post('/history/get' , $scope.input).success(function(d){
				//console.log(d);
				if(d.result){
					$scope.list.bookings = d.data;
					$scope.input.total = d.total;
					$scope.list.bookings.forEach(function(element , index , array){
						var mydate = new Date(element.miliseconds);
						mydate.setFullYear(mydate.getFullYear() + 543);
						element.miliseconds = mydate.getTime();
					});
					$scope.input.total = d.total;
				}
			});
		}

		$scope.nextPage = function(){
			//console.log($scope.input);
			$http.post('/history/get' , $scope.input).success(function(d){
				//console.log(d);
				if(d.result){
					$scope.list.bookings = d.data;
					$scope.list.bookings.forEach(function(element , index , array){
						var mydate = new Date(element.miliseconds);
						mydate.setFullYear(mydate.getFullYear() + 543);
						element.miliseconds = mydate.getTime();
					});
					$scope.input.total = d.total;
				}
			});
		}


	}]);


</script>
@endsection