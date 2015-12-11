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


		{{-- <div class="row min-height">
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
					<button class="btn btn-success" ng-click="save()" ng-hide="mode.save != true">Save</button>
			        <button class="btn btn-info" ng-click="update()" ng-hide="mode.save">Update</button>
					<button class="btn btn-warning" ng-click="reset()">Reset</button>
				</div>
			</div>

		</div> --}}

		{{-- modal --}}
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Detail</h4>
		      </div>
		      <div class="modal-body form-inline">
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
							id="input_close_<% $index %>" name="input_close_<% $index %>" readonly>
						</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button class="btn btn-success" ng-click="save()" ng-hide="mode.save != true">Save</button>
		        <button class="btn btn-info" ng-click="update()" ng-hide="mode.save">Update</button>
				<button class="btn btn-warning" ng-click="reset()">Reset</button>
				<button class="btn btn-danger" ng-click="delete()" ng-hide="mode.save">Delete</button>
		      </div>
		    </div>
		  </div>
		</div><!-- modal -->

	</section>

@endsection

@section('script')
<script src="/js/calendar/fullcalendar.min.js"></script> 
<!-- <script src="/js/calendar-ctrl.js"></script> -->
 <script type="text/javascript">
 	angular.module("myApp").controller('CalendarController', ['$scope' ,'$http' , function($scope , $http){

		$scope.list = {};
		$scope.input = {};
		$scope.list.zone = [];
		$scope.list.empty = [];
		$scope.input.open=[];
		$scope.event = [];
		$scope.mode = {};
		$scope.mode.save = true; 

		$scope.init = function(){
			$http.get('/admin/get/zone').success(function(d){
				$scope.list.empty = d;
				$scope.list.zone = $scope.list.empty;
				$scope.input.open = $scope.list.empty;
			});
			$http.get('/admin/get/calendar').success(function(d){
				if(d == null) return ;
				d.forEach(function(ele, index, array){
					var data = { title : 'Open' ,start : ele.opened_at , color: '#257e4a', overlap: false};	
					$scope.event.push(data);
					$('#calendar').fullCalendar('renderEvent' , data , true);
				});
				
			});
		}

		$scope.save = function(){
			if($scope.input.date == null){
				alert('Please select day befor save agendar.');
				return ;
			}
			//console.log($scope.input.open);
			$http.post('/admin/calendar/save', $scope.input).success(function(d){
				//success
				if(!d.result){ alert('save agendar error.'); return;}
				var data = {title: 'Open',start: $scope.input.date , color: '#257e4a', overlap: false};
				$scope.event.push(data);
				$('#calendar').fullCalendar('renderEvent' , data , true);
				//$('#calendar').fullCalendar( 'refresh' );
				$('#myModal').modal('hide');
				$scope.reset();
			});
		}

		$scope.update = function(){
			if($scope.input.date == null){
				alert('Please select day befor update agendar.');
				return ;
			}
			console.log('update' , $scope.input.open);
			$http.post('/admin/calendar/update', $scope.input).success(function(d){
				if(d.result){
					$('#myModal').modal('hide');
					$scope.reset();
				}
			});
		}

		$scope.delete = function(){
			if($scope.input.date == null){
				alert('Please select day befor update agendar.');
				return ;
			}
			$http.get('/admin/calendar/delete/'+$scope.input.date).success(function(d){
				if(d){
					alert('delete success');
					//$('#calendar').fullCalendar( 'refresh' );
					$('#myModal').modal('hide');
					$scope.reset();
				}
			});
		}

		$scope.reset = function(){
			//alert('reset');
			$scope.list.zone = $scope.list.empty;
			$scope.input.open =  $scope.list.empty;
			$scope.list.zone.forEach(function(ele, index, array){
				$('#input_close_'+index).attr("readonly" , true);
				delete ele.value;
			});
			$scope.input.open.forEach(function(ele, index, array){
				delete ele.value;
				ele.close = 0;
			});
			//console.log('after reset >> ' , $scope.list.zone , $scope.input.open  )
		}

		$scope.removeClass = function(index){
			var ele = $('#input_close_'+index);
			var attr = ele.attr('readonly');
			if (typeof attr !== typeof undefined && attr !== false) {
				ele.removeAttr('readonly');
				$scope.input.open[index].close = 0;
			}
			else $('#input_close_'+index).attr("readonly" , true);
		}

		$scope.hasDayinEvents = function(date){
			var data = $scope.event.filter(function(ele){
				return ele.start == date;
			});
			return data.length > 0 ? true : false;
		}

		$('#calendar').fullCalendar({
			    header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month'
				},
				businessHours: true, 
				editable: true,
				events : $scope.event ,
				eventClick: function(calEvent, jsEvent, view){
					$scope.mode.save = false; 
					$scope.reset();
					//alert('Event start on: ' + calEvent.start.format());
					var dateStr = calEvent.start.format();
					
					$http.get('/admin/get/calendar/'+dateStr).success(function(d){
						//console.log(' eventClick return ' , d);
						$scope.list.zone.forEach(function(zoneItem , index) {  
							var temp = d.filter(function(bItem){ return bItem.code == zoneItem.code })
							if(temp.length > 0){
							 zoneItem.value = true; 
							 zoneItem.close = (temp[0].maxLock - temp[0].availableLock);
							 zoneItem.calendarID = temp[0].id;
							 $('#input_close_'+index).removeAttr('readonly');
							}
						});
						//console.log('return open >> ' , $scope.list.zone);
						$scope.input.open = $scope.list.zone;
						$scope.list.zone = [];
						$scope.list.zone = $scope.list.empty;
						//console.log('return open >> ' , $scope.input.open);
						$scope.input.date = dateStr;
						$('#myModalLabel').html('Detail @ '+$scope.input.date);
						$('#myModal').modal('show');
					});
					$scope.$apply();
				},
				dayClick: function(date, jsEvent, view) {
					if($scope.hasDayinEvents(date.format())){
						alert('This day has in events.');
						return;
					}
					$scope.mode.save = true; 
					$scope.reset();
					$scope.input.date = date.format();
					$('#myModalLabel').html('Detail @ '+$scope.input.date);
					$('#myModal').modal('show');
					$scope.$apply();
				},
		    });
		
		$(document).ready(function() {
		    // page is now ready, initialize the calendar...
		    //input_close_?
		    $('input[name^=\'input_close\']').on(function(){
		    	alert('aaa');
		    });
		});
	
	}]);

 </script>
@endsection