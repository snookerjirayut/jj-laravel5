@extends('welcome')
@section('title', 'Signin')
@section('content')

   
            <div class="row mt centered">
                 @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-lg-6 centered">
                    <h1>GREEN VINTAGE</h1>
                    <h2>เว็บไซต์จองพื้นที่ขายสินค้ากรีนวินเทจ</h2>
                </div><!-- col-lg-6 centered -->
                
                <div class="col-lg-6 centered">
                    <h3>เข้าสู่ระบบ</h3><br>
                    <form class="col-md-12" method="post" action="/signin/valid">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control input-lg" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Sign In</button><br>
                            <span class="pull-left"><a href="#">ลืมรหัสผ่าน?</a></span>
                            <span class="pull-right"><a href="#">ลงทะเบียน</a></span>
                        </div>
                    </form>
                </div><!-- col-lg-6 centered -->
            </div><!-- row mt centered -->  




@endsection