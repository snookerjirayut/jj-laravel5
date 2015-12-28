@extends('welcome')
@section('title', 'Inform')

@section('style')
<link href="/css/dropzone.css" rel="stylesheet">
@endsection

@section('content')
<script src="/js/dropzone.js" ></script>
<script src="/js/angular/angular-dropzone.js" ></script>

<h3 class="text-center">ยืนยันการชำระเงินด้วยหลักฐานการโอน</h3>
<div class="col-sm-6 col-sm-offset-3" ng-controller="UploadController">
	
	<form id="dropzone" name="upload" class="dropzone" action="/inform/upload" method="POST" enctype="multipart/form-data"
		>
		<div class="box-inform-upload">
			
			<img src="/img/icon-upload.png" class="img-responsive">

		</div>
		<div class="dz-default dz-message"></div>
	</form>
	<button class="btn btn-block btn-success btn-upload" type="submit" form="upload">Upload</button>

	{{--  <a class="btn btn-primary" href="" ng-href="<% filename %>"><% filename %></a> --}}
</div>



@endsection
@section('script')

<script type="text/javascript">
	$('#nav-bar li').eq(2).addClass('active');

	angular.module("myApp").controller('UploadController', ['$scope' ,'$http' , function($scope , $http){ 
		
		//var myDropzone = new Dropzone("form#dropzone", { url: "/inform/upload"});
		$scope.input = {};
		$scope.file = {};
		$scope.input.file = {};
		$scope.fileAdded = false;

		$scope.added = function(){
			alert('Success');
		}
		/*$(document).ready(function(){
			myDropzone.on("addedfile", function(file) {
			    $scope.file = file;
                if (this.files[1]!=null) {
                this.removeFile(this.files[0]);
                }
                $scope.$apply(function() {
                    $scope.fileAdded = true;
                });
			});

			myDropzone.on("success", function(data) {
			    var val = JSON.parse(data.xhr.response);
			    if(val.result){
			    	console.log();
				  	alert('file Added success.');
				  	$scope.$apply();
				  	console.log($scope.file);
			    }
			    
			});

		});*/

	}]);


</script>

@endsection