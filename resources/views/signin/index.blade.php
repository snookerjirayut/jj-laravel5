@extends('welcome')
@section('title', 'Signin')
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <!--property start-->

        <div class="row">
            <div class="col-lg-6 col-sm-6 text-center wow fadeInLeft">
                <img src="img/tab1.png" alt="">
            </div> <!--class="col-lg-6 col-sm-6 text-center wow fadeInLeft" end-->

            <div class="col-lg-6 col-sm-6 wow fadeInRight">
                <!--container start-->
                <div class="container">
                    <div class="form-wrapper">
                        <form class="form-signin wow fadeInUp" action="/signin/valid" method="post">

                            <div class="login-wrap">
                                <div class="form-group has-success">
                                    <input type="text" name="email" class="form-control"
                                           placeholder="Email" autofocus>
                                </div>
                                <div class="form-group has-success">
                                    <input type="password" name="password" class="form-control"
                                           placeholder="Password">
                                </div>
                                
                                    <label class="checkbox">
                                        <input type="checkbox" value="remember-me"> 
                                        <span>จำรหัสผ่าน</span> 
                                            <span class="pull-right">
                                                <a data-toggle="modal" href="#myModal"> ลืมรหัสผ่าน?</a>
                                            </span>
                                    </label>
                                                                <button class="btn btn-lg btn-login btn-block" type="submit">เข้าสู่ระบบ</button>
                                

                                <div class="row">
                                    หากคุณยังไม่มีบัญชีผู้ใช้
                                    <a class="" href="/register">
                                        ลงทะเบียนเดี๋ยวนี้
                                    </a>
                                </div> <!-- class="row" end -->
                            </div> <!--class="login-wrap"end -->
                        </form>

                    </div> <!--class="form-wrapper" end -->
                </div> <!-- class="container" end -->
                <!--container start end-->
            </div> <!-- class="col-lg-6 col-sm-6 wow fadeInRight" end -->

        </div> <!-- class="row" end -->

        @endsection

        @section('description')
                <!--recent work start-->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 recent">
                    <h3 class="recent-work">
                        ข่าวสารและกิจกรรม
                    </h3>
                    <p>ข่าวสารและกิจกรรมสำหรับเหล่าพ่อค้าแม่ค้าและนักช๊อป</p>
                    <div id="owl-demo" class="owl-carousel owl-theme wow fadeIn">

                        <div class="item view view-tenth">
                            <img src="img/works/img8.jpg" alt="work Image">
                            <div class="mask">
                                <a href="blog-detail.html" class="info" data-toggle="tooltip" data-placement="top"
                                   title="รายละเอียด">
                                    <i class="fa fa-link"></i>
                                </a>
                            </div>
                        </div>

                        <div class="item view view-tenth">
                            <img src="img/works/img9.jpg" alt="work Image">
                            <div class="mask">
                                <a href="blog-detail.html" class="info" data-toggle="tooltip" data-placement="top"
                                   title="รายละเอียด">
                                    <i class="fa fa-link">
                                    </i>
                                </a>
                            </div>
                        </div>

                        <div class="item view view-tenth">
                            <img src="img/works/img10.jpg" alt="work Image">
                            <div class="mask">
                                <a href="blog-detail.html" class="info" data-toggle="tooltip" data-placement="top"
                                   title="รายละเอียด">
                                    <i class="fa fa-link">
                                    </i>
                                </a>
                            </div>
                        </div>

                        <div class="item view view-tenth">
                            <img src="img/works/img11.jpg" alt="work Image">
                            <div class="mask">
                                <a href="blog-detail.html" class="info" data-toggle="tooltip" data-placement="top"
                                   title="รายละเอียด">
                                    <i class="fa fa-link">
                                    </i>
                                </a>
                            </div>
                        </div>

                        <div class="item view view-tenth">
                            <img src="img/works/img12.jpg" alt="work Image">
                            <div class="mask">
                                <a href="blog-detail.html" class="info" data-toggle="tooltip" data-placement="top"
                                   title="รายละเอียด">
                                    <i class="fa fa-link">
                                    </i>
                                </a>
                            </div>
                        </div>

                        <div class="item view view-tenth">
                            <img src="img/works/img13.jpg" alt="work Image">
                            <div class="mask">
                                <a href="blog-detail.html" class="info" data-toggle="tooltip" data-placement="top"
                                   title="รายละเอียด">
                                    <i class="fa fa-link">
                                    </i>
                                </a>
                            </div>
                        </div>

                    </div> <!-- id="owl-demo" class="owl-carousel owl-theme wow fadeIn end-->
                </div> <!--class="col-lg-12 recent" end-->
            </div> <!--class="row"-->
        </div> <!--class="container end-->


        <!--recent work end-->
@endsection
