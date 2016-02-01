@extends('welcome')
@section('title', 'Inform')

@section('style')
<style type="text/css">
	.error{
		color: #d9534f;
	}
</style>
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-sm-5">
					<h1>สมัครสมาชิก</h1>
				</div>
				<div class="col-lg-7 col-sm-7">
					<ol class="breadcrumb pull-right">
						<li><a href="{{ url('/') }}">หน้าหลัก</a></li>
						<li class="active">สมัครสมาชิก</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
	
<form class="form-horizontal" ng-controller="RegisterController" id="registerForm">
<fieldset>
<!-- Form Name -->
<legend><h1>Register</h1></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput"></label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="Email" 
  class="form-control input-md" ng-model="input.email">

  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password"></label>
  <div class="col-md-4">
    <input id="password" name="password" type="password" placeholder="Password" 
    class="form-control input-md"  ng-model="input.password">
  </div>
</div>
<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password"></label>
  <div class="col-md-4">
    <input id="trypassword" name="trypassword" type="password" placeholder="Try-password" 
    class="form-control input-md" ng-model="input.trypassword">
  </div>
</div>

<hr>

<div class="form-group">
  <label class="col-md-4 control-label" for="name"></label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="User Name" 
  class="form-control input-md" ng-model="input.name">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="firstname"></label>  
  <div class="col-md-4">
  <input id="firstname" name="firstname" type="text" placeholder="First Name" 
  class="form-control input-md" ng-model="input.firstName">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lastname"></label>  
  <div class="col-md-4">
  <input id="lastname" name="lastname" type="text" placeholder="Last Name" 
  class="form-control input-md" ng-model="input.lastName">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tel"></label>  
  <div class="col-md-4">
  <input id="phone" name="phone" type="text" placeholder="Phone number" 
  class="form-control input-md" ng-model="input.phone">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="tel"></label>  
  <div class="col-md-4">
  <textarea name="address" id="address" class="form-control" rows="4" placeholder="Address"
  ng-model="input.address"></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="zipcode"></label>  
  <div class="col-md-4">
  <input id="zipcode" name="zipcode" type="text" placeholder="Zip code" 
  class="form-control input-md" ng-model="input.zipcode" ng-change="getDistrict()">
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="district"></label>  
  <div class="col-md-4">
  <select class="form-control" ng-model="input.district"
  ng-options="district.DISTRICT_ID as district.DISTRICT_NAME for district in districts" ng-change="autoFill()">
  	<option value="">--  --</option>
  </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="amphur"></label>  
  <div class="col-md-4">
  <input type="text" ng-model="input.amphurName" class="form-control" readonly>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="province"></label>  
  <div class="col-md-4">
  <input type="text" ng-model="input.provinceName" class="form-control" readonly>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="submin"></label>  
  <div class="col-md-4">
  <button class="btn btn-info btn-block" ng-click="save()">ยืนยัน</button>
  </div>
</div>



</fieldset>
</form>

@endsection

@section('script')
<script type="text/javascript">
	var form = $('#registerForm');
	angular.module("myApp").controller('RegisterController', ['$scope' ,'$http' , function($scope , $http){

		$scope.input = {};
		$scope.list = {};
		$scope.districts = [];

		$scope.save = function(){
			if(!form.valid()) return;
				
		}

		$scope.getDistrict = function(){
			if($scope.input.zipcode.length < 5) return;
			$http.get('utility/district/'+$scope.input.zipcode).success(function(d){
				if(d.data != null){
					console.log(d.data);
					$scope.districts = d.data;
				}
			});
		}

		$scope.autoFill = function(){
			var district = $scope.input.district;
			if(district == null) return;
			var filed = $scope.districts.filter(function(ele){
				return ele.DISTRICT_ID == district;
			});
			
			var data = filed[0];
			console.log(data);
			$scope.input.amphur = data.AMPHUR_ID;
			$scope.input.amphurName = data.AMPHUR_NAME;
			$scope.input.province = data.PROVINCE_ID;
			$scope.input.provinceName = data.PROVINCE_NAME;
		}


	}]);

	$(document).ready(function(){
		form.validate({
			rules : {
				email : {  required: true, email: true },
				password : { required: true , minlength : 6 , maxlength : 12},
				trypassword : { required: true , minlength : 6 , maxlength : 12 , equalTo : '#password'},
				name : { required: true },
				firstname : { required: true },
				lastname : { required: true },
				phone : { required: true , minlength : 10 , maxlength : 10},
				address  : { required: true },
				zipcode : { required: true , minlength : 5 , maxlength : 5},
			}
		});
	});	
</script>
@endsection