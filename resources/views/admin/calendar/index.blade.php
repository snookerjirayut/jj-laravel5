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
	.panel.panel-default{
		padding-left: 0;
		padding-right: 0;
	}
	.form-group{
		margin-left: 5px;
	}
	.repeat{
		margin-top: 20px;
	}
</style>
@section('content')

	
	<section ng-controller="CalendarController" ng-init="init()">
		{{-- <h2><% name %></h2> --}}
		<div id='calendar'></div>


		<div class="row min-height">
			{{-- CONFIG --}}
			<div class="col-sm-12 panel panel-default">
				<div class="panel-heading"><h2>Config!!</h2></div>
				<div class="form-inline panel-body" >
					<div class="repeat" ng-repeat="zone in list.zone">
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
				</div>
				<div class="panel-footer">
					<button class="btn btn-success" ng-click="save()">Save</button>
					<button class="btn btn-warning" ng-click="reset()">Reset</button>
				</div>
			</div>

		</div>

		{{-- modal --}}
		{{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Detail</h4>
		      </div>
		      <div class="modal-body">
		        <div class="repeat" ng-repeat="zone in list.zone">
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
		      </div>
		      <div class="modal-footer">
		        <button class="btn btn-success" ng-click="save()">Save</button>
				<button class="btn btn-warning" ng-click="reset()">Reset</button>
		      </div>
		    </div>
		  </div>
		</div><!-- modal --> --}}

	</section>

@endsection

@section('script')
<script src="/js/calendar/fullcalendar.min.js"></script> 
<!-- <script src="/js/calendar-ctrl.js"></script> -->
 <script type="text/javascript">
 	angular.module("myApp").controller('CalendarController', ['$scope' ,'$http' , function($scope , $http){
		//var myModal = $('#myModal');
		//var myCalendar = $('#calendar');
		$scope.list = {};
		$scope.input = {};
		$scope.list.zone = [];
		$scope.list.empty = [];
		$scope.input.open=[];

		$scope.event = [];


		$scope.removeClass = function(index){
			var ele = $('#input_close_'+index);
			var attr = ele.attr('readonly');
			if (typeof attr !== typeof undefined && attr !== false) {
				ele.removeAttr('readonly');
				$scope.input.open[index].close = 0;
			}
			else $('#input_close_'+index).attr("readonly" , true);
		}

		$scope.init = function(){
			$http.get('/admin/get/zone').success(function(d){
				//console.log('data', d);
				$scope.list.empty = d;
				$scope.list.zone = d;
				$scope.input.open = d;
			});
			$http.get('/admin/get/calendar').success(function(d){
				if(d == null) return ;
				d.forEach(function(ele, index, array){
					var data = { title : 'Open' ,start : ele.opened_at , color: '#257e4a', overlap: false};	
					$scope.event.push(data);
					//$('#calendar').fullCalendar('renderEvent' , data , true);
				});
				
			});
		}

		$scope.save = function(){
			if($scope.input.date == null){
				alert('Please select day befor save agendar.');
				return ;
			}
			console.log($scope.input.open);
			$http.post('/admin/calendar/save', $scope.input).success(function(d){
				//success
				var data = {title: 'Open',start: $scope.input.date , color: '#257e4a', overlap: false};
				$scope.event.push(data);
				console.log('event >> ' , $scope.event);
				$('#calendar').fullCalendar('renderEvent' , data , true);
				$('#myModal').modal('hide');
			});
		}

		$scope.reset = function(){
			//console.log('reset >> ', $scope.list.empty );
			$scope.list.zone = $scope.list.empty;
			$scope.input.open = $scope.list.empty;
			$scope.list.zone.forEach(function(ele, index, array){
				$('#input_close_'+index).attr("readonly" , true);
			});
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
				events : $scope.event ,
				dayClick: function(date, jsEvent, view) {
					alert('Clicked on: ' + date.format());
					$scope.input.date = date.format();
					$('#myModal').modal('show');
			 /*     alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
			        alert('Current view: ' + view.name);*/
			        // change the day's background color just for fun
			        //$(this).css('background-color', '#449d44');
				},
		    });

		});
	
	}]);

 </script>
@endsection