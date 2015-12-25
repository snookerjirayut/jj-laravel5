@extends('welcome')
@section('title', 'Checkin')
@section('content')


<div ng-controller="CheckinController" class="row" ng-init="init()" style="margin:0">
	<h2 class="text-center">Check-in</h2>
	<div class="col-sm-6 col-sm-offset-3" id="checking"  >

		<div ng-repeat="booking in list.bookings">
			<div class="media">
			  <div class="media-left disable" ng-if="!booking.canCheckIn">
			    <h2 class="lock-number-booking">
			    	<i class="glyphicon glyphicon-map-marker"></i><% booking.status %>
			    </h2>
			  </div>
			  <div class="media-left active" ng-if="booking.canCheckIn">
			    <h2 class="lock-number-booking">
			    	<a href="#" ng-click="checkin($index , booking.code)">
			    		<i class="glyphicon glyphicon-map-marker"></i><% booking.status %>
			    	</a>
			    </h2>
			  </div>
			  <div class="media-body">
			    <h5 class="media-heading"><strong>ID :</strong> <% booking.code %></h5>
			    <h5><strong>Sale at : </strong><% booking.miliseconds | date:'EEEE dd MMMM yyyy' %></h5>
			    
			    <div ng-repeat="detail in booking.bookingDetail" id="box-number-<% $index  %>" >
			    	<div class="col-sm-1 box-child">
			    		<p>&nbsp;<% detail.zoneNumber %></p>
			    	</div>
			    </div>
			    <div class="box-payment-status">
				    <h5>
				    	<span ng-if="booking.payment == 0" class="text-danger">wait payment.</span>
				    	<span ng-if="booking.payment == 1" class="text-info">uploaded slip.</span>
				    	<span ng-if="booking.payment == 2" class="text-success">payment success.</span>
				    </h5>
			    </div>
			  </div>
			  <div class="media-right payement">
			  	<% booking.totalPrice |  number:2 %>&nbsp;฿
			  </div>
			</div>
		</div>

		
	</div>

	<div class="col-sm-8 col-sm-offset-2" style="margin-top:30px">
		<uib-pager total-items="input.total" ng-model="input.currentPage" items-per-page="input.pageSize" ng-change="nextPage()"></uib-pager>
	</div>	

</div>



@endsection

@section('script')
<script type="text/javascript">
	angular.module("myApp").controller('CheckinController', ['$scope' ,'$http' , function($scope , $http){ 

		$scope.list = {};
		$scope.list.bookings = [];

		$scope.input = {}; 
		$scope.input.total = 0;
		$scope.input.pageSize = 10;
		$scope.input.currentPage = 1;

		$scope.init = function(){
			$('#nav-bar li').eq(1).addClass('active');
			$http.post('/checkin/get' , $scope.input).success(function(d){
				if(d.result){
					$scope.list.bookings = d.data;
					$scope.input.total = d.total;
				}
			});
		}

		$scope.nextPage = function(){
			$http.post('/checkin/get' , $scope.input).success(function(d){
				if(d.result){
					$scope.list.bookings = d.data;
					$scope.input.total = d.total;
				}
			});
		}

		$scope.date = function(str_date){
			var day = moment(str_date , 'DD-MMMM-YYYY');
			return day;
		}

		$scope.checkin = function(index , code){
			//alert('test');
			if(index == null) return ;
			var param = $scope.list.bookings[index];
			$http.put('/checkin/save/'+code , param).success(function(d){
				console.log(d);
				if(d.result){
					alert('ID '+code+' check-in is success.');
					$scope.nextPage();
				}
			});

		}

	}]);


</script>
@endsection