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
			    	<i class="glyphicon glyphicon-map-marker"></i>BK
			    </h2>
			  </div>
			  <div class="media-left active" ng-if="booking.canCheckIn">
			    <h2 class="lock-number-booking">
			    	<a href="#" ng-click="checkin()">
			    		<i class="glyphicon glyphicon-map-marker"></i>BK
			    	</a>
			    </h2>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><strong>ID :</strong> <% booking.code %></h4>
			    Sale at : <% booking.miliseconds | date:'EEEE dd MMMM yyyy' %>
			    <div ng-repeat="detail in booking.bookingDetail">
			    	<div class="col-sm-1 box-child">
			    		<p class="">&nbsp;<% detail.zoneNumber %></p>
			    	</div>
			    </div>
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

		$scope.checkin = function(){
			alert('test');
		}

	}]);


</script>
@endsection