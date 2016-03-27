<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <title>Backend - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{  asset('/css/style.css') }}" rel="stylesheet">
       
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css">


        <link href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap/dist/css/bootstrap-theme.min.css')}}" rel="stylesheet">

        <link href="{{ asset('css/style-admin.css') }}" rel="stylesheet">

        <script src="{{ asset('js/jquery.min.js') }}" ></script>
        <script src="{{ asset('js/moment/min/moment.min.js') }}" ></script>
        <script src="{{ asset('css/bootstrap/dist/js/bootstrap.min.js') }}" ></script>


        <script src="{{ asset('js/angular/angular.min.js') }}" ></script>
        <script src="{{ asset('js/angular/ui-bootstrap-tpls.js') }}" ></script>
        <script src="{{ asset('js/angular-i18n/angular-locale_th-th.js')}}" ></script>
        
        @yield('style')
        <style>
            html, body {
                height: 100%;
            }

            @import url(https://fonts.googleapis.com/css?family=Questrial);
            
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

        </style>
    </head>
    <body >
        <!--logo-->
    <div class="col-sm-12 ">
        <img src="{{  asset('/img/header.png') }}" class="img-resposive max-width">
    </div>
         
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            @if(\Auth::user()->role == '99')
            <li class="active"><a href="{{url('/admin/calendar')}}">ปฏิทิน</a></li>
            <li><a href="{{url('/admin/manage')}}">จัดการข้อมูล</a></li>
            <li><a href="{{url('/admin/account')}}">ผู้ดูแลระบบ</a></li>
            <li><a href="{{url('/admin/payment')}}">ชำระเงิน(รายวัน)</a></li>
            <li><a href="{{url('/admin/paymentmonth')}}">ชำระเงิน(รายเดือน)</a></li>
            <li><a href="{{url('/admin/member')}}">สมาชิก</a></li>
            <li><a href="{{url('/admin/verify')}}">ตรวจสอบ</a></li>
            <li><a href="{{url('/admin/signout')}}">ออกจากระบบ</a></li>
            @elseif(\Auth::user()->role == '98')
            <li><a href="{{url('/admin/verify')}}">ตรวจสอบ</a></li>
            <li><a href="{{url('/admin/signout')}}">ออกจากระบบ</a></li>
            @endif
            <!--<li><a href="#">วิเคราะห์</a></li>
            <li><a href="#">ไฟล์</a></li> -->
          </ul>

        </div>

    <div id="main-content" class="col-sm-9 main">
        
        @yield('content')
       
    </div>


    </div>{{-- end container-fluid --}}
</div>
    <script src="/js/app.js"></script>
    @yield('script')
    </body>
</html>
