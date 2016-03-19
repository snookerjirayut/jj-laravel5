<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    
</head>
<body>
    <!-- logo -->
    <div class="col-sm-12 ">
        <img src="{{  asset('img/header.png') }}" class="img-resposive max-width">
    </div>

    <div class="login-wrap">
        <div class="col-lg-12">
            <form class="form-signin wow fadeInUp" method="post" action="{{url('')}}/admin/signin/valid">
                <div class="col-lg-12 text-center "><h3>ADMIN</h3></div>
                <div class="login-wrap">
                     @if (count($errors) > 0)
                <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                </div>
            @endif
                    <div class="form-group has-success">
                        <input type="text" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                            
                    <button class="btn btn-jj btn-block " type="submit">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>     
        </div>
        
        <div class="col-lg-4  "></div>
    </div>  


            
    
    
    
    
  

</body>
</html>

