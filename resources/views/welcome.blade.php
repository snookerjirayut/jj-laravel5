<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <title>Green Vintage - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> --}}
        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

        <script src="/js/jquery.min.js" ></script>
        <script src="/js/moment/min/moment.min.js" ></script>
        <script src="/css/bootstrap/dist/js/bootstrap.js" ></script>
        <!-- Angular core JS -->
        <script src="/js/angular/angular.min.js" ></script>
         <script src="/js/angular-i18n/angular-locale_th-th.js" ></script>
        <script src="/js/angular/ui-bootstrap-tpls.js" ></script>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
        </style>
        <link href="/css/style-member.css" rel="stylesheet">

        <link href="/css/main.css" rel="stylesheet">
        <link href="/css/font-awesome.min.css" rel="stylesheet">
        @yield('style')

    </head>
    <body>
    

    <div class="navbar navbar-default navbar-fixed-top">
    <div class="col-sm-12">
        <ul class="nav nav-pills right">
            @if(\Auth::check()) 
            <li role="presentation" class="disabled">
                <a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;{{ \Auth::user()->name  }}</a>
            </li>
            <li role="presentation">
                <a href="/signout"><i class="glyphicon glyphicon-share-alt"></i>&nbsp;Signout</a>
            </li>
            @endif
        </ul>
    </div>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/" >Green</a>
        </div>
        <div class="navbar-collapse collapse">
            @if(\Auth::check())
            <ul class="nav navbar-nav navbar-right menu-right">
                <li><a href="/booking">จองพื้นที่</a></li>
                <li><a href="/checkin">เช็คอิน</a></li>
                <li><a href="#">แจ้งโอน</a></li>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right menu-right">
                <li><a href="/signin">เข้าสู่ระบบ</a></li>
            </ul>
            @endif
        </div><!--.nav-collapse -->
      </div>
    </div>


        {{-- <div class="container">
            <header>
                <div class="row header-top"></div>
                <div class="row">
                    <ul class="nav nav-pills right">
                       
                        @if(\Auth::check()) 
                        <li role="presentation" class="disabled">
                            <a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;{{ \Auth::user()->name  }}</a>
                        </li>
                        <li role="presentation">
                            <a href="/signout"><i class="glyphicon glyphicon-share-alt"></i>&nbsp;Signout</a>
                        </li>
                        @else
                         <li role="presentation"><a href="/register">
                            <i class="glyphicon glyphicon-user"></i>&nbsp;ลงทะเบียน</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="row relative">
                    <ul class="nav nav-pills">
                        <li role="presentation">
                            <h1>GREEN <br>VINTAGE</h1>
                        </li>
                        @if(\Auth::check())
                        <ul class="nav navbar-nav navbar-right menu-right">
                            <li><a href="/booking">จองพื้นที่</a></li>
                            <li><a href="/checkin">เช็คอิน</a></li>
                            <li><a href="#">แจ้งโอน</a></li>
                        </ul>
                        @else
                        <ul class="nav navbar-nav navbar-right menu-right">
                            <li><a href="/signin">เข้าสู่ระบบ</a></li>
                        </ul>
                        @endif

                    </ul>
                </div>
            </header>

            <div class="content">
               
            </div>

          
        </div> --}}

        <div id="hello">
            <div class="container">
                @yield('content')
            </div>
        </div>
        @yield('description')
        

        <div id="footer">
                <div class="container">
                    <div class="row">
                        <p>Thesis © 2015 | GREEN VINGE MARKET </p>
                    </div>
                </div>
        </div>
       
        <script src="/js/app.js"></script>
        @yield('script')
    </body>
</html>
