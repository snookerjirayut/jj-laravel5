@extends('welcome')
@section('title', 'Signin')
@section('content')

<?php 
	$user = \Auth::user();
?>
<!-- HEAD -->
<div class="row">
	<div class="col-sm-3">
	@if(isset($user->image))
		<img src="{{$user->image}}" class="profile" alt="profile" class="img-circle">
	@else
		<div class="circleBase">
			{{-- <h2>{{ substr($user->name, 0 , 1) }}</h2> --}}
		</div>
	@endif
	<h4 class="text-center">{{$user->name}}</h4>
	@if($user->role == 1)
		<p class="text-center"><small>ผู้ค้าใหม่</small></p>
	@else 
		<p class="text-center"><small>ผู้ค้าประจำ</small></p>
	@endif
	</div>
</div>

<!-- ROW -->
<section ng-controller="BookingController" ng-init="init()">
	<div class="row">
		<div class="col-sm-12">

			<div class="col-sm-3">
				<label>Day</label>
				<select ng-options="day.opened_at as day.name for day in list.days track by day.opened_at" ng-model="input.date" 
				class="form-control" ng-change="getZone()"></select>
			</div>
			<div class="col-sm-3">
				<label>Zone</label>
				<select ng-options="zone.name as zone.name for zone in list.zones track by zone.name" ng-model="input.zoneName" 
				class="form-control"></select>
			</div>
			<div class="col-sm-3">
				<label>Product Name</label>
				<input name="productName" ng-model="input.productName" class="form-control">
			</div>
			<div class="col-sm-2">
				<label>Number</label>
				<select ng-options="number.id as number.name for number in list.numbers track by number.id" ng-model="input.number" 
				class="form-control"></select>
			</div>
			<div class="col-sm-1">
				<label>&nbsp;</label>
				<button class="btn btn-info" ng-click="search()">Search</button>
			</div>

		</div>
	</div>


</section>


<!-- SUM -->

@endsection

@section('script')
<!-- <script src="/js/booking-ctrl.js"></script> -->
<script type="text/javascript">
	angular.module("myApp").controller('BookingController', ['$scope' ,'$http' , function($scope , $http){

		$scope.list = {};
		$scope.list.days = [];
		$scope.list.numbers = [{id:1, name:1},{id:2, name:2},{id:3, name:3}]; 
		$scope.input = {};

		$scope.init = function(){
			$http.get('/booking/calendar/day/get').success(function(d){
				console.log(d);
				$scope.list.days = d;
			});
		}

		$scope.getZone = function(){
			if($scope.input.date == null || $scope.input == "?"){
				alert('Please select day before zone.');
				return;
			}
			$http.get('/booking/calendar/zone/get/'+$scope.input.date).success(function(d){
				console.log(d);
				$scope.list.zones = d;
			});
		}

		$scope.search = function(){
			//console.log($scope.input);
			//validate
			$http.post('/booking/search' , $scope.input).success(function(d){
				console.log(d);
				if(d.result){

				}
			});
		}




	}]);

</script>
@endsection