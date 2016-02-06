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
	.box-lock{
		float: left;
		margin-left: 5px;
	}
	select.form-control{
		min-width: 210px;
	}
	a.label-link{
		color: #fff;
	}
	a.label-link:hover{
		color: #ccc;
	}

	</style>
@endsection

@section('content')

<h3>Verify</h3>
<div ng-controller="VerifyController" ng-init="init()">
	<div class="panel panel-default">
	  <div class="panel-heading">
	  	<div class="form-inline">
	  		<div class="form-group">
	  			<select ng-model="input.date" class="form-control"
	  			ng-change="getZone()"
	  			ng-options="date.opened_at as date.miliseconds | date:'EEEE dd MMMM y' for date in list.date"
	  		 	ng-options="zone.zoneID as zone.code+'-'+zone.name for date in list.zone">
	  			</select>
	  		</div>

	  		<div class="form-group">
	  			<select ng-model="input.zone" class="form-control"
	  		 	ng-options="zone.zoneID as (zone.code+' - '+zone.name) for zone in list.zone">
	  			</select>
	  		</div>

	  		<button type="buttton" class="btn btn-info" ng-click="search()">Search</button>
	  	
	  	</div>
	  </div>
	  <div class="panel-body">
	   		<div class="col-sm-12">
	   			<table class="table table-striped table-bordered">
	   				<thead>
	   					<tr>
	   						<td  width="5%">IDX</td>
	   						<td  width="20%">Member</td>
	   						<td  width="20%">LockNumber</td>
	   						<td  width="5%" class="text-center">CheckIn</td>
	   						<td  width="5%" class="text-center">Payment type</td>
	   						<td  width="5%" class="text-center">Payment status</td>
	   						<td  width="5%" class="text-center">Verify</td>
	   						<td  width="5%" class="text-center">#</td>
	   					</tr>
	   				</thead>
	   				<tbody>
	   					<tr ng-repeat="(key, value) in list.table">
	   						<td><% value.id %></td>
	   						<td><% value.user.name %></td>
	   						<td>
	   							<div ng-repeat="(keydetail, detail) in value.detail" class="box-lock">
	   								<span class="label label-info"><% detail.zoneNumber %></span>
	   							</div>
	   						</td>
	   						<td class="text-center">
	   							<div ng-if="value.status == 'CN'" class="label label-success">Y</div>
	   							<div ng-if="value.status != 'CN'" class="label label-danger">N</div>
	   						</td>
	   						<td class="text-center">
	   							<div ng-if="value.type == 1" class="label label-primary">TRAN</div>
	   							<div ng-if="value.type == 2" class="label label-info">SALE</div>
	   						</td>
	   						<td class="text-center">
	   							<div ng-if="value.payment == 0" class="label label-warning">Waiting</div>
	   							<div ng-if="value.payment == 1" class="label label-info">
	   								<a href="<% value.picture %>" target="_blank">Uploaded</a>
	   							</div>
	   							<div ng-if="value.payment == 2" class="label label-success">
	   								<a href="<% value.picture %>" target="_blank" class="label-link">Approved</a>
	   							</div>
	   						</td>
	   						<td  class="text-center">
	   							<div ng-if="value.verify == 0" class="label label-warning">Waiting</div>
	   							<div ng-if="value.verify == 1" class="label label-success">Verified</div>
	   						</td>
	   						<td class="text-center">
	   							<a href="javascript:void(0)" ng-click="verify(value.id , $index)" class="btn btn-success btn-xs">
	   								<i class="glyphicon glyphicon-check"></i>
	   							</a>
	   						</td>
	   					</tr>
	   				</tbody>
	   			</table>
	   		</div>
	  </div>

	   <div class="panel-footer">
	   		
	   </div>
	</div>

</div>
	
@endsection


@section('script')

	<script type="text/javascript">
		angular.module("myApp").controller('VerifyController', ['$scope' ,'$http' , function($scope , $http){
			$scope.input = {};
			$scope.input.total = 0;
			$scope.input.page = 1;
			$scope.input.pageSize = 20;

			$scope.list = {};
			$scope.list.date = [];

			$scope.init = function(){
				$http.get("{{url('/admin/get/calendar')}}").success(function(data){
					console.log(data.active);
					$scope.list.date = data.active;
				});
			}

			$scope.getZone = function(){
				$http.get("{{url('/admin/get/zone')}}/"+$scope.input.date).success(function(data){
					console.log(data.zone);
					$scope.list.zone = data.zone;
				});
			}

			$scope.search = function(){
				$http.post("{{ url('/admin/verify/get') }}" , $scope.input).success(function(d){
					console.log(d);
					if(d.result){
						$scope.list.table = d.data;
					}
				});
			}

			$scope.verify = function(id , index){
				console.log(id , index)
				if(index == null && id == null) return;
				$http.get("{{ url('/admin/verify/update/') }}/"+id).success(function(d){
					console.log(d)
					if(d.result){
						$scope.list.table[index] = d.data[0];
						alert("Verified");
					}else alert(d.message);
				});
			}

			

		}]);
	</script>

@endsection