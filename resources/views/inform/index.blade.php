@extends('welcome')
@section('title', 'Inform')

@section('style')
<link href="/css/dropzone.css" rel="stylesheet">
@endsection

@section('content')
<script src="/js/dropzone.js" ></script>
{{-- <script src="/js/angular/angular-dropzone.js" ></script> --}}

<h3 class="text-center">ยืนยันการชำระเงินด้วยหลักฐานการโอน</h3>
<div class="col-sm-6 col-sm-offset-3" ng-controller="UploadController" ng-init="init()">
	<div class="col-sm-12 box-inform-date">
		<p class="text-center">วันที่จอง</p>
		<select ng-model="input.code" ng-options="booking.code as booking.miliseconds | date:'EEEE dd MMMM y' for booking in list.booking" class="form-control box-select-date"></select>
	</div>
	<form id="dropzone" name="upload" class="dropzone col-sm-12" action="/inform/upload" method="POST" enctype="multipart/form-data"
		>
		<div class="box-inform-upload">
			
			<img src="/img/icon-upload.png" class="img-responsive">

		</div>
		<div class="dz-default dz-message"></div>
	</form>
	<button class="btn btn-block btn-success btn-upload" type="button" ng-click="save()">Upload</button>

	{{--  <a class="btn btn-primary" href="" ng-href="<% filename %>"><% filename %></a> --}}
</div>

@endsection
@section('script')

<script type="text/javascript">
	$('#nav-bar li').eq(2).addClass('active');

	angular.module("myApp").controller('UploadController', ['$scope' ,'$http' , function($scope , $http){ 
		
		var myDropzone = new Dropzone("form#dropzone", { url: "/inform/upload" ,  clickable: false});
		$scope.input = {};
		$scope.list = {};
		$scope.list.booking = [];

		$scope.file = {};
		$scope.input.file = {};
		$scope.fileAdded = false;

		//miliseconds
		$scope.init = function(){
			$http.get('/inform/feed').success(function(d){
				$scope.list.booking = d.data;
			});
		}
		$scope.save = function(){
			$http.put('/inform/update/'+$scope.input.code, $scope.input).success(function(data){
				console.log(data);
				if(data.result){
					alert('อัพโหลดเสร็จเรียบร้อย');
					window.location = '/inform';
				}else{
					alert(data.messge);
				}
			});
		}

		$(document).ready(function(){
			myDropzone.on("addedfile", function(file) {
			    $scope.file = file;
                if (this.files[1]!=null) {
                	this.removeFile(this.files[0]);
                }
                $scope.$apply(function() {
                    $scope.fileAdded = true;
                });
			});

			myDropzone.on('sending', function(file, xhr, formData){
	            formData.append('filename', $scope.input.code );
	        });

			myDropzone.on("success", function(data) {
			    var val = JSON.parse(data.xhr.response);
			    if(val.result){
			    	console.log(val);
				  	$scope.input.file = val.filename;
				  	$scope.$apply();
			    }else{
			    	alert(val.message);
			    	$('div.dz-success').remove();
			    }
			    
			});

		});

	}]);


</script>

@endsection