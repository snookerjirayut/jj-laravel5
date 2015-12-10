@extends('backlayout')

@section('style')

@endsection
<link href="/js/calendar/fullcalendar.css" rel="stylesheet">
<style type="text/css">
	a.fc-day-grid-event.fc-h-event{
		padding-top: 5px;
		padding-bottom: 5px;
	}
</style>
@section('content')

	{{-- <h1>Calendar</h1> --}}
	<section ng-controller="CalendarController">
		{{-- <h2><% name %></h2> --}}
		<div id='calendar'></div>

	</section>

@endsection

@section('script')
<script src="/js/calendar/fullcalendar.min.js"></script> 
<!-- <script src="/js/calendar-ctrl.js"></script> -->
 <script type="text/javascript">
 	angular.module("myApp").controller('CalendarController', ['$scope' ,'$http' , function($scope , $http){
		
		$scope.name  = "snooker";
		$(document).ready(function() {

		    // page is now ready, initialize the calendar...

		    $('#calendar').fullCalendar({
			    header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month'
				},
				businessHours: true, // display business hours
				editable: true,
				events :[
					{
						title: 'Open',
						start: '2015-12-13 00:00:00',
						overlap: false,
						color: '#257e4a'
					}
				],
				dayClick: function(date, jsEvent, view) {
					alert('Clicked on: ' + date.format());
			 /*       alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
			        alert('Current view: ' + view.name);*/
			        // change the day's background color just for fun
			        $(this).css('background-color', '#449d44');
				},
		    });

		});
	
	}]);

 </script>
@endsection