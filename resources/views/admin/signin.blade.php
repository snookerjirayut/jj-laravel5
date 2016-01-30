<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    
</head>
<body>
    <div class="col-sm-12 ">
        <img src="{{  asset('img/header.png') }}" class="img-resposive max-width">
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
            
    
    
    <div class="login-wrap">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <img src="{{  asset('img/logo.png') }}" class="img-responsive img-center">
            <div class="col-lg-12 text-center "><h3>ADMIN</h3></div>

            <form role="form" form method="post" action="{{url('')}}/admin/signin/valid">
                <div class="login-wrap">
                    <div class="form-group has-success">
                        <input type="text" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                            
                    <button class="btn btn-info btn-lg btn-block " type="submit">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>     
        </div>
        
        <div class="col-lg-4  "></div>
    </div>  


            
    
    
    
    
  

</body>
</html>

