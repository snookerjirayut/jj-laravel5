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
<h3>Member</h3>
<div ng-controller="MemberController">
	<div class="panel panel-default">
	  <div class="panel-heading">
	  	<div class="form-inline">
	  		<div class="form-group">
				<label>Type</label>
				<select ng-options="type.id as type.name 
				for type in list.type" ng-model="input.type" ng-disabled="ui.type"
				ng-change="ui.status = false"
				class="form-control select-booking-date"></select>
			</div>

			<div class="form-group">
				<label>Status</label>
				<select ng-options="status.id as status.name 
				for status in list.status" ng-model="input.status" ng-disabled="ui.status"
				ng-change="ui.search = false "
				class="form-control select-booking-date"></select>
			</div>

			<div class="form-group">
				<label>Email</label>
				<input class="form-control" ng-model="input.email"  placeholder="member@gmail.com">
			</div>
			<button class="btn btn-info" ng-click="search()"  >Search</button>

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
	  						<td>Name</td>
	  						<td>Email</td>
	  						<td>Full Name</td>
	  						<td>Tel</td>
	  						<td>Create</td>
	  					</tr>
	  				</thead>
	  				<tbody>
	  					<tr ng-repeat="obj in table.member">
	  						<td><% obj.id %></td>
	  						<td><% obj.code %></td>
	  						<td><% obj.name %></td>
	  						<td><% obj.email %></td>
	  						<td><% obj.firstName+' '+obj.lastName %></td>
	  						<td><% obj.phone %></td>
	  						<td><% obj.created_at %></td>
	  					</tr>
	  				</tbody>
	  			</table>
	  		</div>
	  	</div>
	  	<div class="row">
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


</div>


@endsection

@section('script')
<script type="text/javascript">
		angular.module("myApp").controller('MemberController', ['$scope' ,'$http' , function($scope , $http){
			$scope.input = {};
			$scope.input.total = 0;
			$scope.input.page = 1;
			$scope.input.pageSize = 20;

			$scope.ui = { type:false, status:true,email:false,search:true };

			$scope.table = {};

			$scope.list = {};
			$scope.list.type = [{id:99, name: 'ALL'} , {id:1 , name: 'Guest'},{id:2 , name: 'Member'}];
			$scope.list.status = [{id:99, name: 'ALL'},{id:1 , name: 'Active'},{id:2 , name: 'Inactive'}];
			

			$scope.search = function(){
				$http.post("{{url('/admin/member/search')}}",$scope.input).success(function(d){
					console.log(d);
					if(d.result){
						$scope.table.member = d.data;
						$scope.input.total = d.total;
						if(d.total == 0){ alert('Data not found.'); }
					}
				});
			}

			$scope.pageChanged = function(){
				$http.post("{{url('/admin/member/search')}}",$scope.input).success(function(d){
					console.log(d);
					if(d.result){
						$scope.table.member = d.data;
						$scope.input.total = d.total;
					}
				});
			}

		}]);
	</script>

@endsection