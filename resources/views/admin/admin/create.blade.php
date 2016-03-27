@extends('backlayout')

@section('title' , 'Admin manage')
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
<h3 class="text-center">Create Admin</h3>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('status'))
	@if(session('status') == 'success')
		<p class="alert alert-success text-center"> Create Admin success. </p>
	@else
		<p class="alert alert-danger text-center"> Create Admin fail. </p>
	@endif
@endif

<div>
	<form name="admin-form" method="post" action="{{ url('/admin/account/create') }}" class="form-horizontal">
					
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">FirstName</label>  
		  <div class="col-md-4">
		  <input id="firstname" name="firstname" type="text" placeholder="" class="form-control input-md" >
		    
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">LastName</label>  
		  <div class="col-md-4">
		  <input id="lastname" name="lastname" type="text" placeholder="" class="form-control input-md" >
		    
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">Tel</label>  
		  <div class="col-md-4">
		  <input id="tel" name="tel" type="text" placeholder="" class="form-control input-md" >
		    
		  </div>
		</div>

		<hr>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">Email</label>  
		  <div class="col-md-4">
		  <input id="email" name="email" type="email" class="form-control input-md" >
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="password">Password</label>
		  <div class="col-md-4">
		    <input id="password" name="password" type="password" placeholder="" class="form-control input-md" >
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="confirm">Confirm Password</label>
		  <div class="col-md-4">
		    <input id="confirm" name="confirm" type="password" placeholder="" class="form-control input-md" >
		    
		  </div>
		</div>

		<!-- Select Multiple -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="role">Role</label>
		  <div class="col-md-4">
		    <select id="role" name="role" class="form-control" multiple="multiple">
		      <!-- <option value="99">Admin</option> -->
		      <option value="98" selected="">ผู้ตรวจสอบ</option>
		    </select>
		  </div>
		</div>

		<!-- Button (Double) -->
		<div class="form-group">
		  
		  <div class="col-md-4 col-md-offset-5">
		    <button id="save" name="save" type="submit" class="btn btn-info">Save</button>
		    <button id="back" name="back" class="btn btn-warning">Back</button>
		  </div>
		</div>

	</form>
</div>


@endsection

@section('script')

@endsection