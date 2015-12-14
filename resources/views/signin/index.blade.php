@extends('welcome')
@section('title', 'Signin')
@section('content')
   
    <div class="col-sm-6 col-sm-offset-3" class="login-form">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="post" action="/signin/valid">
            <div class="row">
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="row">
               <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        	<div class="row">
                <button type="submit" class="btn btn-block btn-success">Submit</button>
            </div>
        	
        </form>
    </div>


@endsection