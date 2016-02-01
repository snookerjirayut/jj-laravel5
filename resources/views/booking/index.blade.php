@extends('welcome')
@section('title', 'Booking')
@section('breadcrumbs')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-4">
					<h1>จองพื้นที่</h1>
				</div>
				<div class="col-lg-8 col-sm-8">
					<ol class="breadcrumb pull-right">
						<li><a href="{{ url('/') }}">หน้าหลัก</a></li>
						<li class="active">จองพื้นที่</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('content')

<?php 
	$user = \Auth::user();
	$milliseconds = round(microtime(true) * 1000);
?>

<!-- ROW -->
<section ng-controller="BookingController" ng-init="init()" id="BookingController">
	<div class="row" style="margin-right:0;margin-left:0;margin-bottom:20px;">
		<div class="col-sm-12">
			
			<div class="controls col-lg-3 col-sm-3 form-group has-success">
				<label>วันที่จอง</label>
				@if(\Auth::user()->role == 2)
					<select ng-options="day.opened_at as day.name | date:'EEEE dd MMMM y'
					for day in list.days track by day.opened_at" ng-model="input.date" 
					class="form-control" ng-change="getZone()"></select>
				@elseif(\Auth::user()->role == 1)
					<select ng-options="day.opened_at as day.name | date:'EEEE dd MMMM y'
					for day in list.days_guest track by day.opened_at" ng-model="input.date" 
					class="form-control" ng-change="getZone()"></select>
				@endif
			</div>
			<div class="controls col-lg-3 col-sm-3 form-group has-success">
				<label>เลือกโซน</label>
				<select ng-options="zone.name as zone.name for zone in list.zones track by zone.name" 
				ng-model="input.zoneName" ng-disabled="ui.zone" ng-change="openUI()"
				class="form-control"></select>
			</div>
			<div class="controls col-lg-3 col-sm-3 form-group has-success">
				<label>ระบุสินค้า</label>
				<input name="productName" ng-model="input.productName" ng-disabled="ui.number" class="form-control">
			</div>
			<div class="controls col-lg-3 col-sm-3  ">
				<div class="controls col-lg-6 col-sm-6 form-group has-success">
					<label>จำนวนล็อค</label>
					<select ng-options="number.id as number.name for number in list.numbers track by number.id" ng-model="input.number" 
					class="form-control" ng-disabled="ui.number"></select>
				</div>
				<div class="controls col-lg-6 col-sm-6 form-group has-success">
					<label>&nbsp;ค้นหา</label>
					<button class="btn btn-info" ng-click="search()" ng-disabled="input.number == null">ตกลง</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-right:0;margin-left:0;">
		<div class="col-sm-8">
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
		<div class="col-sm-4 box-booking-summary" ng-show="input.checked != null">
			
			<div >
				<h5 class="text-center">เช่าล๊อคของวันที่ <% input.date  | date:'EEEE dd MMMM y' %></h5>
				<hr>
				<div class="col-sm-12 box-booking-item" ng-repeat="item in list.item" >
					<div class="col-sm-8 text-left">
						No. <% item.name %> *  <% item.amount %> ล็อค
					</div> 
					<div class="col-sm-4 text-right"><% item.price | number:2 %> <small>บาท</small></div>
				</div>
				<div class="col-sm-12">
					<hr>
					<div class="text-center"> <small>วิธีการชำระเงิน</small> </div>
					<div class="col-sm-8 col-sm-offset-2 ">
						<label class="checkbox">
							<input type="radio" ng-model="input.type" value="1">
							 &nbsp;&nbsp;&nbsp;ชำระผ่านธนาคาร
						</label>
						<label class="checkbox">
							<input type="radio" ng-model="input.type" value="2">
							 &nbsp;&nbsp;ชำระ ณ วันที่ขายสินค้า
						</label>
					</div>
				</div>
				<div class="col-sm-12 text-center box-booking-total">
					<label>ยอดชำระ <% input.totalPrice | number:2 %> บาท</label>
				</div>
				
				<div class="col-sm-8 col-sm-offset-2 box-booking-button">
					<button class="btn btn-primary btn-lg btn-block" 
					ng-click="booking()" ng-disabled="ui.buttonBooking">จองพื้นที่</button>
				</div>
				
			</div>

		</div>
		
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
		$scope.list.type = [{id:1, name:'ชำระผ่านธนาคาร'},{id:2, name:'ชำระ ณ วันที่ขายสินค้า'}]
		$scope.list.zoneCode = [];
		$scope.list.zoneBlock = [];
		$scope.list.zoneBlockDisable = [];

		$scope.input = {};
		$scope.input.totalPrice = 0;
		$scope.input.type = 1;
		$scope.ui = {};
		$scope.ui.booking = true;
		$scope.ui.zone = true;
		$scope.ui.number = true;
		$scope.ui.button = true;
		$scope.ui.panalPrice = true;
		$scope.ui.buttonBooking = true;

		$scope.parentIndex = 0;
		$scope.childIndex = 0;

		$scope.booking = function(){
			$scope.input.products = $scope.list.item;
			if($scope.input.type == null){ alert('กรุณาเลือกวิธีการชำระเงิน'); return; }
			console.log($scope.input);
			if($scope.list.item != null){
				$http.post('/booking/create',$scope.input).success(function(d){
					console.log(d);
					if(d.result){
						window.location = '/summary/'+d.bookingCode;
					}
				});
			}
		}


		$scope.showPrice = function(){
			var arr_item = [];
			if($scope.input.checked == null) return;
			var arr_code = Object.keys($scope.input.checked);
			@if(\Auth::user()->role == 1)
			var aprice = $scope.list.zoneCode[0].price_type1;
			@else 
			var aprice = $scope.list.zoneCode[0].price_type2;
			@endif 

			$scope.input.totalPrice = 0;
			
				arr_code.forEach(function(ele , index){
					var acode = ele.substring(0 , 1);
					$scope.input.totalPrice += aprice;
					arr_item.push({id:index , code:acode ,name : ele, price :aprice ,amount:1 });
				});
			

			console.log(arr_item);
			$scope.list.item = arr_item;
			$scope.ui.panalPrice = false;
		}

		$scope.checkValue = function(id ,$event){
			
			var a = $scope.input.checked;
			if(Object.keys(a).length > 0){
				Object.keys(a).forEach(function(ele ,index){
					if(!$scope.input.checked[ele]){ 
						delete $scope.input.checked[ele];
						//console.log('in >>', index , ele , $scope.input.checked[ele] , $scope.input.checked);
					}
				});
			}
			
			
			if(Object.keys(a).length > $scope.input.number){
				alert('limit '+$scope.input.number+' block.');
				delete $scope.input.checked[id];
			}

			if(Object.keys(a).length == $scope.input.number) {
				$scope.ui.booking = false;
				$scope.ui.buttonBooking =false;
			}

			console.log($scope.input.checked);
			$scope.showPrice();

		}

		$scope.init = function(){
			$('#nav-bar li:first-child').addClass('active');
			$http.get('/booking/calendar/day/get').success(function(d){
				console.log(d);
				$scope.list.days = d;
				$scope.list.days_guest = [{miliseconds: '{{ $milliseconds }}' , name:  '{{ $milliseconds }}' ,opened_at: '{{ date('Y-m-d') }}' }];
				console.log($scope.list.days_guest);
			});
		}

		$scope.getZone = function(){
			if($scope.input.date == null || $scope.input.date == "?"){
				alert('Please select day before zone.');
				return;
			}
			$http.get('/booking/calendar/zone/get/'+$scope.input.date).success(function(d){
				console.log('zone',d);
				if(d.length == 0) return alert('ไม่พบการเปิดตลาด');
				$scope.list.zones = d;
				$scope.ui.zone = false;
			});
		}

		$scope.search = function(){
			//validate
			$scope.input.checked = {};
			$scope.list.item = [];
			

			$http.post('/booking/search' , $scope.input).success(function(d){
				//console.log(d);
				if(d.result){
					$scope.ui.panalPrice = true;
					$scope.list.zoneCode = d.data;
					$scope.list.zoneCode.forEach(function(element, index, array){
						var arr = [];
						for (i = 1; i <= element.availableLock ; i++) { 
							var blockid = element.code+'-'+i;
							arr.push({id:blockid , status:'available' , check: false});
						}
						$scope.list.zoneBlock[index] = arr;
					});
					//console.log('block' , $scope.list.zoneBlock);
					setTimeout(function(){
						$scope.blockDisable();
					}, (2000));
				}else{ 
					delete $scope.input.checked;
					delete $scope.list.item ;
					alert(d.message); 
				}
			});
		}

		$scope.setTimeout = function(time){
			 setTimeout(function(){
		    	$scope.blockDisable();
		    }, (1000*time));
		}

		$scope.blockDisable = function(){
			$http.post('/booking/calendar/block/get', $scope.input).success(function(d){
				if(d != null){
					console.log($scope.input.checked);
					$scope.list.zoneBlockDisable = d;
					$scope.list.zoneBlockDisable.forEach(function(element, index, array){
						Object.keys($scope.input.checked).forEach(function(ele){
							if(ele == element.zoneNumber) delete $scope.input.checked[ele];
						});
						$('input#'+element.zoneNumber).prop("disabled", true);
					});

					$scope.setTimeout(10);
				}
			});
		}

		$scope.openUI = function(){
			if($scope.input.zoneName != null || $scope.input.zoneName != "?") $scope.ui.number = false;
			else $scope.ui.number = true;
		}
		


	}]);

</script>
@endsection