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
<h3>สมาชิก</h3>
<div ng-controller="MemberController">
	<div class="panel panel-default">
	  <div class="panel-heading">
	  	<div class="form-inline">
	  		<div class="form-group">
				<label>ประเภท</label><br>
				<select ng-options="type.id as type.name 
				for type in list.type" ng-model="input.type" ng-disabled="ui.type"
				ng-change="ui.status = false"
				class="form-control select-booking-date"></select>
			</div>

			<div class="form-group">
				<label>อีเมล</label><br>
				<input width="8%"class="form-control" ng-model="input.email"  placeholder="">
			</div>
			<div class="form-group">
				<label>&nbsp;</label><br>
				<button class="btn btn-info" ng-click="search()"  >ตกลง</button>
			</div>
	  	</div>
	  </div>
	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-sm-12">
	  			<table class="table table-striped table-bordered ">
	  				<thead>
	  					<tr class="text-center">
	  						<td>ลำดับ</td>
	  						<td>ประเภท</td>
	  						{{-- <td>ชื่อผู้ใช้</td> --}}
	  						<td>อีเมล</td>
	  						<td>ชื่อ-นามสกุล</td>
	  						<td>เบอร์โทร</td>
	  						<td>วันที่ลงทะเบียน</td>
	  						<td>รายละเอียด</td>
	  					</tr>
	  				</thead>
	  				<tbody>
	  					<tr ng-repeat="obj in table.member">
	  						<td><% obj.id %></td>
	  						<td><% memberRole(obj.role) %></td>
	  						{{-- <td><% obj.name %></td> --}}
	  						<td><% obj.email %></td>
	  						<td><% obj.firstName+' '+obj.lastName %></td>
	  						<td><% obj.phone %></td>
	  						<td><% obj.created_at %></td>
	  						<td class="text-center"><a href="#detail" ng-click="showDetail($index)"><i class="glyphicon glyphicon-search"></i></a></td>
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
				<p>จำนวนแถว : <% input.total %></p>
			</div>
	  	</div>
	  </div>
	  <div class="panel-footer">
	  	
	  </div>
	</div>

	<div class="detail" ng-hide="ui.detail" id="detail">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-3">
						<label>อีเมล</label>
						<input class="form-control" ng-model="detail.email"  readonly>
					</div>

					<div class="col-sm-3">
						<label>ชื่อ</label>
						<input class="form-control" ng-model="detail.firstName"  >
					</div>

					<div class="col-sm-3">
						<label>นามสกุล</label>
						<input class="form-control" ng-model="detail.lastName"  >
					</div>

					<div class="col-sm-3">
						<label>เบอร์โทร</label>
						<input class="form-control" ng-model="detail.phone"  >
					</div>

					<div>
						<div class="col-sm-3">
							<label>ที่อยู่</label>
							<textarea class="form-control" ng-model="detail.address" rows="4"></textarea>
						</div>

						<div class="col-sm-3">
							<label>ประเภท</label>
							<select ng-options="role.id as role.name 
							for role in list.role" ng-model="detail.role" 
							class="form-control select-booking-date"></select>
						</div>

					</div>
					

				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-success" ng-click="update()">อัพเดต</button>
				<button class="btn btn-info" ng-click="booking()" ng-show="detail.role == 2">จอง</button>
			</div>
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

			$scope.detail = {};

			$scope.ui = { type:false, status:true,email:false,search:true,detail:true };

			$scope.table = {};

			$scope.list = {};
			$scope.list.type = [{id:99, name: 'ทั้งหมด'} , {id:1 , name: 'ลูกค้าจร'},{id:2 , name: 'ลูกค้าประจำ'}];
			$scope.list.status = [{id:99, name: 'ทั้งหมด'},{id:1 , name: 'ปกติ'},{id:2 , name: 'ยกเลิก'}];
			$scope.list.role = [{id:1 , name: 'ลูกค้าจร'},{id:2 , name: 'ลูกค้าประจำ'}];
			
			$scope.booking = function(){
				if($scope.detail.id == null) return ;
				var win = window.open('{{ url('/admin/booking') }}/'+$scope.detail.id, '_blank');
  				win.focus();
			}

			$scope.memberRole = function(role){
				if(role == 1) return "ผู้ค้าจร" ; 
				else if (role == 2) return "ผู้ค้าประจำ" ; 
				else return "undefine"
			}
			
			$scope.update = function(){
				if($scope.detail.id == null) return ;
				$http.put("{{url('/admin/member/update')}}/"+$scope.detail.id  , $scope.detail ).success(function(d){
					if(d.result){
						$scope.table.member[$scope.input.index] = d.data;
						alert('update success.');
					}else alert(d.message);
				});
			}

			$scope.search = function(){
				$scope.ui.detail
				$http.post("{{url('/admin/member/search')}}",$scope.input).success(function(d){
					console.log(d);
					if(d.result){
						$scope.table.member = d.data;
						$scope.input.total = d.total;
						if(d.total == 0){ alert('Data not found.'); }
						$scope.ui.detail = true;
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

			$scope.showDetail = function(index){
				if(index == null)return;
				$scope.input.index = index;
				$scope.detail = $scope.table.member[index];
				console.log($scope.detail);
				$scope.ui.detail = false;
			}



		}]);
	</script>

@endsection