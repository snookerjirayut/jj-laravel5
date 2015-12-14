@extends('welcome')
@section('title', 'Signin')
@section('content')

<?php 
	$user = \Auth::user();
?>
<!-- HEAD -->
<div class="row">
	<div class="col-sm-3 col-sm-offset-4" style="margin-bottom:20px;">
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
	<div class="row" style="margin-right:0;margin-left:0;margin-bottom:20px;">
		<div class="col-sm-12">

			<div class="col-sm-3">
				<label>Day</label>
				<select ng-options="day.opened_at as day.name for day in list.days track by day.opened_at" ng-model="input.date" 
				class="form-control" ng-change="getZone()"></select>
			</div>
			<div class="col-sm-3">
				<label>Zone</label>
				<select ng-options="zone.name as zone.name for zone in list.zones track by zone.name" 
				ng-model="input.zoneName" ng-disabled="ui.zone" ng-change="openUI()"
				class="form-control"></select>
			</div>
			<div class="col-sm-3">
				<label>Product Name</label>
				<input name="productName" ng-model="input.productName" ng-disabled="ui.number" class="form-control">
			</div>
			<div class="col-sm-2">
				<label>Number</label>
				<select ng-options="number.id as number.name for number in list.numbers track by number.id" ng-model="input.number" 
				class="form-control" ng-disabled="ui.number"></select>
			</div>
			<div class="col-sm-1">
				<label>&nbsp;</label>
				<button class="btn btn-info" ng-click="search()" ng-disabled="input.number == null">Search</button>
			</div>

		</div>
	</div>
	<div class="row" style="margin-right:0;margin-left:0;">
		<div class="book-tbl" ng-repeat="zoneCode in list.zoneCode" ng-init="parentIndex = $index" 
		on-finish-render="ngRepeatFinished">
			<ul>
				<li ng-repeat="block in list.zoneBlock[parentIndex]">
					<input id="<% block.id %>" type="checkbox" 
						ng-model="input.checked[block.id]" ng-checked="block.check" 
						ng-click="checkValue(block.id , $event)"/>
					<label for="<% block.id %>"><% block.id %></label>
				</li>
			</ul>
		</div>
	</div>

	<div class="row">
		<button class="btn btn-success" ng-click="booking()" ng-hide="ui.booking">booking</button>
	</div>

</section>


<!-- SUM -->

@endsection

@section('script')
<!-- <script src="/js/booking-ctrl.js"></script> -->
<script type="text/javascript">
	angular.module("myApp")
	.directive('onFinishRender', function ($timeout) {
	    return {
	        restrict: 'A',
	        link: function (scope, element, attr) {
	            if (scope.$last === true) {
	                $timeout(function () {
	                    scope.$emit('ngRepeatFinished');
	                });
	            }
	        }
	    }
	})
	.controller('BookingController', ['$scope' ,'$http' , function($scope , $http){

		$scope.list = {};
		$scope.list.days = [];
		$scope.list.numbers = [{id:1, name:1},{id:2, name:2},{id:3, name:3}]; 
		$scope.list.zoneCode = [];
		$scope.list.zoneBlock = [];
		$scope.list.zoneBlockDisable = ["D-29" , "D-10" , "E-10", "E-11" , "E-12", "I-10", "I-11" , "I-12"];
		$scope.input = {};
		$scope.ui = {};
		$scope.ui.booking = true;
		$scope.ui.zone = true;
		$scope.ui.number = true;
		$scope.ui.button = true;

		$scope.parentIndex = 0;
		$scope.childIndex = 0;

		$scope.checkValue = function(id ,$event){
			//alert(id);
			Object.prototype.getKeyByValue = function( value ) {
		    for( var prop in this ) {
			    if( this.hasOwnProperty( prop ) ) {
			        if( this[ prop ] === value )
			            return prop;
			        }
			    }
			}

			var a = $scope.input.checked;
			console.log('id > ', id);
			var filOut = a.getKeyByValue(false);
			if(filOut != null){
				//console.log('filOut > ', filOut);
				delete  $scope.input.checked[filOut];
				//console.log('after filOut >> ',$scope.input.checked);
			}

			if(Object.keys(a).length > $scope.input.number){
				alert('limit '+$scope.input.number+' block.');
				//uncheck 
				//$($event.target).attr("ng-checked" , false);
				delete $scope.input.checked[id];
				//console.log('after delete >> ',$scope.input.checked);
				return false;
			}

		}

		$scope.booking = function(){
			console.log($scope.input.checked , 'number >>' , $scope.input.number);
		}

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
				//console.log(d);
				$scope.list.zones = d;
				$scope.ui.zone = false;
			});
		}

		$scope.search = function(){
			//validate
			$http.post('/booking/search' , $scope.input).success(function(d){
				//console.log(d);
				if(d.result){
					$scope.list.zoneCode = d.data;
					$scope.list.zoneCode.forEach(function(element, index, array){
						var arr = [];
						for (i = 1; i <= element.availableLock ; i++) { 
							var blockid = element.code+'-'+i;
							arr.push({id:blockid , status:'available' , check: false});
						}
						$scope.list.zoneBlock[index] = arr;
					});
					console.log('block' , $scope.list.zoneBlock);
				}
			});
		}

		$scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
		    //you also get the actual event object
		    //do stuff, execute functions -- whatever...
		    $scope.list.zoneBlockDisable.forEach(function(element, index, array){
				//console.log(element);
				$('input#'+element).prop("disabled", true);
			});
		});

		$scope.openUI = function(){
			if($scope.input.zoneName != null || $scope.input.zoneName != "?") $scope.ui.number = false;
			else $scope.ui.number = true;
		}
		


	}]);

</script>
@endsection