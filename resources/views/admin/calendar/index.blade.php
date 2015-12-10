@extends('backlayout')
@section('content')
<h1>Calendar</h1>
<section ng-controller="CalendarController">
	<h2><% name %></h2>


</section>

@endsection

@section('script')
<!-- <script src="/js/calendar-ctrl.js"></script> -->
 <script type="text/javascript">
 	angular.module("myApp").controller('CalendarController', ['$scope' ,'$http' , function($scope , $http){
		
		$scope.name  = "snooker";
		
	
	}]);

 </script>
@endsection