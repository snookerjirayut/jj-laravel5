@extends('backlayout')
@section('title' , 'Calendar')
@section('style')
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
@endsection

@section('content')

	
	<section ng-controller="CalendarController" ng-init="init()">

		<div id='calendar'></div>

		{{-- modal --}}
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">รายละเอียด</h4>
		         <button class="btn btn-warning btn-sm" ng-click="closeDay()" ng-hide="mode.save">ปิด</button>
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
							<label>สูงสุด</label>
							<input type="text" value="<% zone.maxLock %>"  class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>ปิด</label>
							<input type="text" ng-model="input.open[$index].close" class="form-control" 
							id="input_close_<% $index %>" name="input_close_<% $index %>" readonly>
						</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button class="btn btn-success" ng-click="save()" ng-hide="mode.save != true" id="btn_save">บันทึก</button>
		        <button class="btn btn-info" ng-click="update()" ng-hide="mode.save">อัพเดต</button>
				<button class="btn btn-warning" ng-click="reset()">รีเซต</button>
				<button class="btn btn-danger" ng-click="delete()" ng-hide="mode.save">ลบ</button>
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
		$scope.input.open =[];
		$scope.input.dates = [];
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
				d.active.forEach(function(ele, index, array){
					var data = {id : index , title : 'Open' ,start : ele.opened_at , overlap: false , color :'#257e4a' , active : ele.active};
					$scope.event.push(data);
					$('#calendar').fullCalendar('renderEvent' , data , true);
				});
				d.inactive.forEach(function(ele, index, array){
					var data = {id : index , title : 'Close' ,start : ele.opened_at , overlap: false , color :'#cccccc' ,active : ele.active};
					$scope.event.push(data);
					$('#calendar').fullCalendar('renderEvent' , data , true);
				});

				console.log($scope.event);
				
			});
		}

		$scope.calendarUpdate = function(){
			$('#calendar').fullCalendar('removeEvents');
			$scope.event = [];
			$http.get('/admin/get/calendar').success(function(d){
				if(d == null) return ;
				d.active.forEach(function(ele, index, array){
					var data = {id : index , title : 'Open' ,start : ele.opened_at , overlap: false , color :'#257e4a' };
					$scope.event.push(data);
					$('#calendar').fullCalendar('renderEvent' , data , true);
				});
				d.inactive.forEach(function(ele, index, array){
					var data = {id : index , title : 'Close' ,start : ele.opened_at , overlap: false , color :'#cccccc'};
					$scope.event.push(data);
					$('#calendar').fullCalendar('renderEvent' , data , true);
				});
				console.log($scope.event);
			});
		}

		$scope.save = function(){
			if($scope.input.dates.length <= 0){
				alert('Please select day befor save agendar.');
				return ;
			}
			//console.log($scope.input);
			$('#btn_save').button('loading');
			$http.post('/admin/calendar/save', $scope.input).success(function(d){
				//success
				$('#btn_save').button('reset');
				if(!d.result){ alert('save agendar error.'); return;}
				$scope.calendarUpdate();
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

		$scope.closeMonth = function(date , callback){
			if(date == null) return ;
			$http.get('/admin/calendar/close/month/'+date).success(function(d){
				if(d != null)
					callback(d.message);
			});
		}

		$scope.closeDay = function(){
			if($scope.input.date == null)return;
			if(confirm('Please confirm for close '+$scope.input.date)){
				$http.get('/admin/calendar/close/day/'+$scope.input.date).success(function(d){
					if(d.result){
						alert(d.message);
						//$scope.input.index
						var index = $scope.input.index;
						$("#calendar").fullCalendar( 'removeEvents'  ,  index );
						var data = {id : index , title : 'Close' ,start:$scope.input.date , overlap: false , color :'#cccccc'};
						$scope.event[index] = data;
						$('#calendar').fullCalendar('renderEvent' , data , true);
						$('#myModal').modal('hide');
						$scope.reset();
					}else alert(d.message);
				});
				

			}
			
		}

		$('#calendar').fullCalendar({
				customButtons: {
			        closeButton: {
			            text: 'Close',
			            click: function(calEvent, jsEvent, view) {
			            	var day = $("#calendar").fullCalendar('getDate');
			            	$scope.closeMonth(day.format() , function(msg){
			            		$scope.calendarUpdate();
			            		$scope.$apply();
			            	});
			            }
			        },
					monthlyButton:{
						text: 'Monthly',
						click: function(calEvent, jsEvent, view) {
							console.log($scope.input.dates);
							$('#myModalLabel').html('Monthly');
							$('#myModal').modal('show');
							$scope.$apply();
						}
					}
			    },
			    header: {
					left: 'prev,next today closeButton monthlyButton',
					center: 'title',
					right: 'month'
				},
				businessHours: true, 
				editable: true,
				events : $scope.event ,
				eventClick: function(calEvent, jsEvent, view){
					$scope.mode.save = false; 
					$scope.reset();
					$scope.input.index = calEvent.id;
					if(calEvent.title === 'Close') return;
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
						$('#myModalLabel').html('รายละเอียด วันที่ '+$scope.input.date);
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
					//$scope.input.date = date.format();
					$scope.input.dates.push(date.format());
					var data = {id : date.format() , title : 'mark' ,start : date.format() , overlap: false , color :'#f0ad4e'};
					$scope.event.push(data);
					$('#calendar').fullCalendar('renderEvent' , data , true);

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