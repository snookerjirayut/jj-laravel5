@extends('backlayout')

@section('title' , 'Payment')
@section('style')
	<style type="text/css">
	.select-booking-date{
		min-width: 150px;
	}
	.table{
		margin-top: 20px;
	}
	.form-group label{
		margin-left: 10px;
	}
	thead tr td {
		font-weight: bold;
	}
	.last-box{
		margin-bottom: 20px;
	}
	</style>
@endsection

@section('content')
	<h3>Payment</h3>
<div ng-controller="PaymentController" ng-init="init()">
	<div class="panel panel-default">
	  <div class="panel-heading">
	  	<div class="row" style="margin: 20px 0;">
					<div class="col-sm-12">
						<div  class="form-inline">
							<div class="form-group">
								<label>Date</label>
								<select ng-options="day.opened_at as day.opened_at | date:'EEEE dd MMMM y' 
								for day in list.days track by day.opened_at" ng-model="input.date"  ng-disabled="ui.date"
								class="form-control select-booking-date"  ng-change="getZone()"></select>
							</div>

							<div class="form-group">
								<label>Zone</label>
								<select ng-options="zone.id as zone.code +' - '+zone.name
								for zone in list.zones" ng-model="input.zone"  ng-disabled="ui.zone"
								class="form-control select-booking-date" ng-change="ui.type = false" ></select>
							</div>

							<div class="form-group">
								<label>Type</label>
								<select ng-options="type.id as type.name
								for type in list.types" ng-model="input.type"  ng-disabled="ui.type"
								class="form-control select-booking-date"  ng-change="ui.status = false"></select>
							</div>


							<div class="form-group">
								<label>Status</label>
								<select ng-options="status.id as status.name
								for status in list.status" ng-model="input.status"  ng-disabled="ui.status"
								class="form-control select-booking-date"  ></select>
							</div>
							
							<button class="btn btn-info" ng-click="search()" >Search</button>
						</div>
					</div>

				</div>

	  </div>
	  <div class="panel-body">
	   		
				<div class="row">
					<div class="col-sm-12">

						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>IDX</td>
									<td>Code</td>
									<td>Product</td>
									<td>Qty</td>
									<td>Price</td>
									<td>Status</td>
									<td>Payment</td>
									<td>Create</td>
									<td>&nbsp;</td>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="obj in table.payment">
									<td><% obj.id %></td>
									<td>
										<a href="javascript://" ng-click="openModal(obj.id)"><% obj.code %></a>
									</td>
									<td><% obj.productName %></td>
									<td><% obj.quantity %></td>
									<td><% obj.totalPrice %></td>
									<td>
										<div ng-if="obj.status == 'BK'">
											Booking
										</div>
										<div ng-if="obj.status == 'CN'">
											Booking
										</div>
									</td>
									<td>
										<div ng-if="obj.payment == 0">
											Wait
										</div>
										<div ng-if="obj.payment == 1">
											<a href="<% obj.picture %>" target="_blank">Uploaded</a>
										</div>
										<div ng-if="obj.payment == 2">
											<a href="<% obj.picture %>" target="_blank">Approved</a>
										</div>
									</td>
									<td><% obj.created_at %></td>
									<td>
										<div ng-if="obj.payment == 1">
											<button class="btn btn-xs btn-warning" ng-click="approve(obj.id)">Approve</button>
										</div>
										<div ng-if="obj.payment == 2">
											<label class="label label-success">Approved</label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-12">
						<uib-pagination total-items="input.total" ng-model="input.page" 
						items-per-page="input.pageSize"
						ng-change="pageChanged()"></uib-pagination> 
						<p>total of record : <% input.total %></p>
					</div>

				</div>
	  </div>

	   <div class="panel-footer">
	   		
	   </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Booking Code <% modal.booking.code %></h4>
	      </div>
	      <div class="modal-body">
	       <div class="col-sm-12 last-box">
	        	<% modal.detail.type == 1 ?  'โอนเงิน' : 'ชำระ ณ​ วันขายสินค้า'  %>
	        	<div ng-if="modal.booking.payment == 0">
					<a href="#" target="_blank">รอการโอนเงินและอัพโหลดหลักฐานการโอน</a>
				</div>
				<div ng-if="modal.booking.payment == 1">
					<a href="<% obj.picture %>" target="_blank">อัพโหลดหลักฐานการโอนเงินแล้ว</a>
				</div>
				<div ng-if="modal.booking.payment == 2">
					<a href="<% modal.booking.picture %>" target="_blank">อนุมัติแล้ว</a>
				</div>
	        </div>
	        <div class="col-sm-6"> </div>
	        <div class="col-sm-6"> 
	        	<p><% modal.user.firstName+' '+modal.user.lastName %></p>
	        	<p><% modal.user.address %></p>
	        	<p><% modal.user.phone %></p>
	        </div>
	       
	        <table class="table table-striped table-bordered">
	        	<thead>
		        	<tr>
		        		<td class="text-center">#</td>
		        		<td class="text-center">Zone</td>
		        		<td class="text-center">Number</td>
		        		<td class="text-center">Qty</td>
		        		<td class="text-center">Price</td>
		        	</tr>
	        	</thead>
	        	<tr ng-repeat="obj in modal.booking.detail">
	        		<td class="text-center"><% $index + 1 %></td>
	        		<td class="text-center"><% obj.zoneCode %></td>
	        		<td class="text-center"><% obj.zoneNumber %></td>
	        		<td class="text-center">1</td>
	        		<td class="text-center"><% obj.price %></td>
	        	</tr>
	        	<tr>
	        		<td colspan="4" class="text-right">Grand Total</td>
	        		<td class="text-center"> <strong><% modal.booking.totalPrice|number %></strong> </td>
	        	</tr>
	        </table>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	      </div>
	    </div>
	  </div>
	</div>


</div>
	
@endsection


@section('script')

	<script type="text/javascript">
		angular.module("myApp").controller('PaymentController', ['$scope' ,'$http' , function($scope , $http){
			$scope.input = {};
			$scope.input.total = 0;
			$scope.input.page = 1;
			$scope.input.pageSize = 20;

			$scope.ui = { zone:true, data:true,type:true,status:true };

			$scope.table = {};

			$scope.list = {};
			$scope.list.status = [{id:99 , name:'ALL - ทั้งหมด'} ,{id:0 , name: 'Booking'} , {id:1 , name: 'Uploaded'}
			, {id:2 , name: 'Approved'}];
			$scope.list.types = [{id:99 , name:'ALL - ทั้งหมด'} ,{id:1 , name: 'โอนเงิน'} , {id:2 , name: 'ชำระ ณ วันขาย'}];

			$scope.modal = {};

			$scope.approve = function(data){
				//alert(data);
				if(data == null) return; 
				$scope.input.bookingid = data;
				if(!confirm('Please confirm the approve of booking id '+data)) return;
				$http.post("{{url('/admin/payment/update')}}", $scope.input).success(function(d){
					if(d.result){
						alert('Booking ID '+data+' approved.');
						$scope.pageChanged();
					}else alert(d.message);
				})
			}

			$scope.openModal = function(id){
				if(id == null) return;
				$http.get("{{ url('/admin/payment/show') }}/"+id).success(function(d){
					if(d.result){
						console.log(d.data);
						$scope.modal.user = d.user;
						$scope.modal.booking = d.data;
						$('#myModal').modal('show');
					}else alert(d.message);
				});
			}

			$scope.init = function(){
				$http.get("{{url('/admin/payment/date')}}").success(function(d){
					//console.log(d);
					if(d.result){
						$scope.list.days  = d.data;
						$scope.ui.date = false;
					}else alert(d.message);
				});
			}

			$scope.getZone = function(){
				$http.get("{{url('/admin/payment/zone')}}/"+$scope.input.date).success(function(d){
					console.log(d);
					if(d.result){
						d.data.splice(0, 0, { id:99 , name:'ทั้งหมด' , code: 'ALL' });
						$scope.list.zones  = d.data;
						$scope.ui.zone = false;
					}else alert(d.message);
				});
			}

			$scope.search = function(){
				$http.post("{{url('/admin/payment/search')}}",$scope.input).success(function(d){
					console.log(d);
					if(d.result){
						$scope.table.payment = d.data;
						$scope.input.total = d.total;
						if(d.total == 0){ alert('Data not found.'); }
					}
				});
			}

			$scope.pageChanged = function(){
				$http.post("{{url('/admin/payment/search')}}",$scope.input).success(function(d){
					console.log(d);
					if(d.result){
						$scope.table.payment = d.data;
						$scope.input.total = d.total;
					}
				});
			}

		}]);
	</script>

@endsection