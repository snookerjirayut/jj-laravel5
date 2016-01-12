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
	</style>
@endsection

@section('content')
	<h3>Payment</h3>
	<div ng-controller="PaymentController" ng-init="init()">
		<div class="row" style="margin: 20px 0;">
			<div class="col-sm-12">
				<div  class="form-inline">
					<div class="form-group">
						<label>Date</label>
						<select ng-options="day.opened_at as day.opened_at | date:'EEEE dd MMMM y'
						for day in list.days track by day.opened_at" ng-model="input.date" 
						class="form-control select-booking-date" placeholder="booking date" ng-change="getZone()"></select>
					</div>

					<div class="form-group">
						<label>Zone</label>
						<select ng-options="zone.id as zone.code +' - '+zone.name
						for zone in list.zones" ng-model="input.zone" 
						class="form-control select-booking-date"  ></select>
					</div>

					<div class="form-group">
						<label>Type</label>
						<select ng-options="type.id as type.name
						for type in list.types" ng-model="input.type" 
						class="form-control select-booking-date"  ></select>
					</div>


					<div class="form-group">
						<label>Status</label>
						<select ng-options="status.id as status.name
						for status in list.status" ng-model="input.status" 
						class="form-control select-booking-date"  ></select>
					</div>
					

					<button class="btn btn-info" ng-click="search()" >Search</button>
				</div>
			</div>

		</div>
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
							<td><% obj.code %></td>
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
									Approved
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
@endsection


@section('script')

	<script type="text/javascript">
		angular.module("myApp").controller('PaymentController', ['$scope' ,'$http' , function($scope , $http){
			$scope.input = {};
			$scope.input.total = 0;
			$scope.input.page = 1;
			$scope.input.pageSize = 20;

			$scope.table = {};

			$scope.list = {};
			$scope.list.status = [{id:99 , name:'ALL - ทั้งหมด'} ,{id:0 , name: 'booking'} , {id:1 , name: 'uploaded'}
			, {id:2 , name: 'approved'}];
			$scope.list.types = [{id:99 , name:'ALL - ทั้งหมด'} ,{id:1 , name: 'transfer'} , {id:2 , name: 'with holding'}];

			$scope.approve = function(data){
				alert(data);
			}

			$scope.init = function(){
				$http.get("{{url('/admin/payment/date')}}").success(function(d){
					//console.log(d);
					if(d.result){
						$scope.list.days  = d.data;
					}else alert(d.message);
				});
			}

			$scope.getZone = function(){
				$http.get("{{url('/admin/payment/zone')}}/"+$scope.input.date).success(function(d){
					console.log(d);
					if(d.result){
						d.data.splice(0, 0, { id:99 , name:'ทั้งหมด' , code: 'ALL' });
						$scope.list.zones  = d.data;
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