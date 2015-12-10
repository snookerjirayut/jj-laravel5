@extends('backlayout')

@section('style')

@endsection
<link href="/js/calendar/fullcalendar.css" rel="stylesheet">
<style type="text/css">
	a.fc-day-grid-event.fc-h-event{
		padding-top: 5px;
		padding-bottom: 5px;
	}
	.min-height{
		min-height: 300px;
		padding: 30px;
	}
	.form-inline{
		margin: 10px;
	}
	.form-group{
		margin-left: 5px;
	}
</style>
@section('content')

	{{-- <h1>Calendar</h1> --}}
	<section ng-controller="CalendarController" ng-init="init()">
		{{-- <h2><% name %></h2> --}}
		<div id='calendar'></div>


		<div class="row min-height">
			{{-- CONFIG --}}
			<div class="col-sm-12">

				<div class="form-inline" ng-repeat="zone in list.zone">
					<div class="col-sm-6 form-group">
						<input type="checkbox" ng-model="input.open[$index].value" id="input_<% $index %>" ng-change="removeClass($index)">
						<label for='input_<% $index %>' tabindex="-1" class="checkbox">
						  <span class="check"></span>
						  <% 'Block '+zone.code +' '+zone.name %>
						</label>
					</div>
					<div class="form-group">
						<label>Max</label>
						<input type="text" value="<% zone.maxLock %>"  class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Close</label>
						<input type="text" ng-model="input.open[$index].close" class="form-control" 
						id="input_close_<% $index %>" readonly>
					</div>

				</div>
				<button class="btn" ng-click="save()">Save</button>

			</div>
			<div class="col-sm-6">
			</div>
		</div>
	</section>

@endsection

@section('script')
<script src="/js/calendar/fullcalendar.min.js"></script> 
<!-- <script src="/js/calendar-ctrl.js"></script> -->
 <script type="text/javascript">
 	angular.module("myApp").controller('CalendarController', ['$scope' ,'$http' , function($scope , $http){
		
		$scope.name  = "snooker";
		$scope.list = {};
		$scope.input = {};
		$scope.list.zone = [];

		$scope.input.open=[];

		$scope.removeClass = function(index){
			var ele = $('#input_close_'+index);
			var attr = ele.attr('readonly');
			if (typeof attr !== typeof undefined && attr !== false)
				{
					console.log(true);
					ele.removeAttr('readonly');
				}
			else {
				console.log(false);
				$('#input_close_'+index).attr("readonly" , true);
			}
		}

		$scope.init = function(){
			$http.get('/admin/get/zone').success(function(d){
				console.log('data', d);
				$scope.list.zone = d;
			});
		}

		$scope.save = function(){
			console.log($scope.input.open);
		}

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