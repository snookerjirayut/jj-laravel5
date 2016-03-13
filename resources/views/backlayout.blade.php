<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <title>Backend - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
       
        <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>


        <link href="/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

        <link href="/css/style-admin.css" rel="stylesheet">

        <script src="/js/jquery.min.js" ></script>
        <script src="/js/moment/min/moment.min.js" ></script>
        <script src="/css/bootstrap/dist/js/bootstrap.min.js" ></script>


        <script src="/js/angular/angular.min.js" ></script>
        <script src="/js/angular/ui-bootstrap-tpls.js" ></script>
        <script src="/js/angular-i18n/angular-locale_th-th.js" ></script>
        
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

    <nav class="navbar navbar-inverse ">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">JJ-GREEN</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="#">Dashboard</a></li> -->
            <li><a href="#">ตั้งค่า</a></li>
            <li><a href="{{url('/admin/signout')}}">ออกจากระบบ</a></li>
            <li><a href="#">ช่วยเหลือ</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="ค้นหา">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">หน้าแรก<span class="sr-only">(current)</span></a></li>
            <li><a href="{{url('/admin/calendar')}}">ปฏิทิน</a></li>
              <li><a href="{{url('/admin/manage')}}">จัดการข้อมูล</a></li>
            <li><a href="{{url('/admin/payment')}}">ชำระเงิน(รายวัน)</a></li>
              <li><a href="{{url('/admin/paymentmonth')}}">ชำระเงิน(รายเดือน)</a></li>
            <li><a href="{{url('/admin/member')}}">สมาชิก</a></li>
            <li><a href="{{url('/admin/verify')}}">ตรวจสอบ</a></li>
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
