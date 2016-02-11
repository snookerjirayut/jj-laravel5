@extends('welcome')
@section('title', 'Inform')
@section('style')
<style type="text/css">
	.error{
		color: #d9534f;
	}
</style>
@endsection



@section('content')

        <form class="form-horizontal form-group has-success form-register  wow fadeInUp" ng-controller="RegisterController" id="registerForm" >
     	<div class="row col-xs-12 register">
			<h1>ลงทะเบียนเพื่อจองพื้นที่</h1><br>
				<span>ยินดีต้อนรับสู่ตลาดนัดกรีน วินเทจ เราคือวิธีที่สะดวกที่สุดในการจองพื้นที่ขายสินค้า	
				<br>brง่ายเพียงแตะปุ่ม สร้างบัญชีของคุณและเริ่มจองพท้นที่ในไม่กี่นาที</span>	
		</div><br>

            <div class="row">
            	<!-- F-name input -->
                <div class="col-xs-6 ">
                    <input id="firstname" name="firstname" type="text" placeholder="ชื่อ" class="form-control input-md" ng-model="input.firstName">
                </div>
                <!-- L-name input -->
                <div class="col-xs-6 ">
                    <input id="lastname" name="lastname" type="text" placeholder="นามสกุล" class="form-control input-md" ng-model="input.lastName">
                </div>
            </div>

            <!-- CardID input -->
            <div class="row">
                <div class="col-xs-12 ">
                    <input id="cardID" name="cardID" type="text" placeholder="เลขบัตรประจำตัวประชาชน" class="form-control input-md" ng-model="input.cardID">
                </div>
            </div>

            <!-- Add input -->
            <div class="row">
                <div class="col-xs-12 ">
                    <textarea name="address" id="address" class="form-control" rows="3" placeholder="ที่อยู่" ng-model="input.address"></textarea>
                </div>
            </div>

            <div class="row">
            	<!-- Zipcode input -->
                <div class="col-xs-6 ">
                    <input id="zipcode" name="zipcode" type="text" placeholder="รหัสไปรษณีย์" class="form-control input-md" ng-model="input.zipcode" ng-change="getDistrict()">
                </div>
                <!-- District input -->
                 <div class="col-xs-6 ">
                    <select class="form-control" ng-model="input.district" ng-options="district.DISTRICT_ID as district.DISTRICT_NAME for district in districts" ng-change="autoFill()">
                    <option value="">เลือกตำบล</option>
                </select>
                </div>
            </div>

            <div class="row">
            	<!-- Amphur insert -->
                <div class="col-xs-6 ">
                     <input type="text" ng-model="input.amphurName" class="form-control" readonly>
                </div>

                <!-- Province insert -->
                 <div class="col-xs-6 ">
                    <input type="text" ng-model="input.provinceName" class="form-control" readonly>
                </div>
            </div>

            <!-- Phone input -->
            <div class="row">
                <div class="col-xs-12 ">
                    <input id="phone" name="phone" type="text" placeholder="เบอร์มือถือ" class="form-control input-md" ng-model="input.phone">    
                </div>
            </div>

            <!-- Email input -->
            <div class="row">
                 <div class="col-xs-12 ">
                    <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" ng-model="input.email">
                </div>
            </div>
			
			<!-- Username input -->
            <div class="row">
                <div class="col-xs-12 ">
                    <input id="name" name="name" type="text" placeholder="User Name" class="form-control input-md" ng-model="input.name"> 
                </div>
            </div>


            <div class="row">
            	<!-- PW input -->
                <div class="col-xs-6 ">
                    <input id="password" name="password" type="password" placeholder="รหัสผ่าน" class="form-control input-md" ng-model="input.password">
                </div>
                <!-- Try-PW input -->
                <div class="col-xs-6 ">
                    <input id="trypassword" name="trypassword" type="password" placeholder="ยืนยันรหัสผ่าน" class="form-control input-md" ng-model="input.trypassword">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <button class="btn btn-lg btn-info btn-block" ng-click="save()">สร้างบัญชี</button>
                </div>
            </div>
    
          
    
      
    

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
			console.log($scope.input);
			
			$http.post('/register/valid',$scope.input).success(function(d){
				console.log(d)
				if(d.result){
					alert(d.message);
					window.location = '/signin';
				}else alert(d.message);
			});	
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
			$scope.input.districtName = data.DISTRICT_NAME;
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
				cardID : {required: true , minlength : 13 , maxlength : 13},
				phone : { required: true , minlength : 9 , maxlength : 10},
				address  : { required: true },
				zipcode : { required: true , minlength : 5 , maxlength : 5},
			},
            messages:{
                email : { required : 'กรุณากรอก email' , email : 'กรุณากรอกให้อยู่ในรูปแบบ email' },
                password : { required: 'กรุณากรอกรหัสผ่าน' , minlength : 'ความยาวอย่างน้อย 6 ตัวอักษร' , maxlength : 'ความยาวสูงสุด 12 ตัวอักษร'},
                trypassword : { required: 'กรุณากรอกรหัสผ่าน' , minlength : 'ความยาวอย่างน้อย 6 ตัวอักษร' , maxlength : 'ความยาวสูงสุด 12 ตัวอักษร', equalTo : 'กรอกใหม่อีกครั้ง'
                },
                name : { required: 'กรุณาระบุชื่อผู้ใช้งาน' },
                firstname : { required: 'กรุณารุบบชื่อ' },
                lastname : { required: 'กรุณารุบะนามสกุล' },
                cardID : {required: 'กรุณาระบุเลขบัตรประชาชน' , minlength : 'กรุณากรอกให้ครบ 13 หลัก' , maxlength : 'สามารถกรอกได้ 13 ตัวอักษร'},
                phone : { required: 'กรุณาระบุเบอร์โทรศัพท์' , minlength : 'ความยาวอย่างน้อย 9 ตัวอักษร' , maxlength : 'ความยาวสูงสุด 10 ตัวอักษร'},
                address  : { required: 'กรุณาระบุที่อยู่' },
                zipcode : { required: 'กรุณาระบุรหัสไปรษณีย์' , minlength : 'ความยาวอย่างน้อย 5 ตัวอักษร' , maxlength : 'ความยาวสูงสุด 5 ตัวอักษร'},
            }
		});
	});	
</script>
@endsection