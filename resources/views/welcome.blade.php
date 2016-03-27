<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <title>Green Vintage - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-reset.css') }}" rel="stylesheet">

    <!--external css-->
    <link href="{{ asset('/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{  asset('/css/flexslider.css') }}"/>
    <link href="{{  asset('assets/bxslider/jquery.bxslider.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{  asset('/css/animate.css') }}">
    <link rel="stylesheet" href="{{  asset('/assets/owlcarousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{  asset('/assets/owlcarousel/owl.theme.css') }}">

    <link href="{{  asset('/css/superfish.css') }}" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{  asset('/css/component.css') }}">

    <link href="{{  asset('/css/style-member.css') }}" rel="stylesheet">
    <link href="{{  asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{  asset('/css/style-responsive.css') }}" rel="stylesheet"/>

    <script src="{{  asset('/js/jquery.min.js') }}"></script>
    <script src="{{  asset('/js/moment/min/moment.min.js') }}"></script>
    <script src="{{  asset('/css/bootstrap/dist/js/bootstrap.js') }}"></script>
    <!-- Angular core JS -->
    <script src="{{  asset('/js/angular/angular.min.js') }}"></script>
    <script src="{{  asset('/js/angular-i18n/angular-locale_th-th.js') }}"></script>
    <script src="{{  asset('/js/angular/ui-bootstrap-tpls.js') }}"></script>

    <script src="{{  asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{  asset('/js/additional-methods.min.js') }}"></script>

    @yield('style')

</head>
<body>
    <!--logo-->
    <div class="col-sm-12 ">
        <img src="{{  asset('/img/header.png') }}" class="img-resposive max-width">
    </div>
    
    <!--header start-->      
    <header class="head-section">
        <div class="navbar navbar-default navbar-static-top container">
            <div class="col-lg-12 col-sm-12">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>

            <div class="navbar-collapse collapse">
                <div class="col-lg-11 col-sm-11">
                    <div class="navbar-collapse collapse">
                        
                        <ul class="nav navbar-nav">
                        @if(\Auth::check())
                            <li><a href="/checkin">เช็คอิน</a></li>
                            <li><a href="/booking">จองพื้นที่</a></li>
                            <li><a href="/inform">แจ้งโอน</a></li>
                        @endif
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
                            "dropdown" data-toggle="dropdown" href="#">ข่าวสารและกิจกรรม <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="blog.html">ข่าวสารและกิจกรรม</a>
                                </li>
                                <li>
                                    <a href="price-table-one.html">ราคาโซนขายสินค้า</a>
                                </li>
                                <li>
                                    <a href="faq.html">คำถาม</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/contact">ติดต่อเรา</a>
                        </li>   
                    </ul>
                </div>
            </div>

            <div class="col-lg-1 col-sm-1">
                <!-- USER OPTIONS -->
                <!--User active start-->
                    @if(\Auth::check())
                    <div class="userSection">
                        <div class="userSection__dropdownToggle" data-toggle="dropdown">
                            <div class="userSection__userAvatar">
                                <img class="" src="http://placehold.it/150x150" alt="User Avatar">
                            </div>
    
                        </div>
                        <ul class="userSection__userMenu">
                            <li class="userSection__userMenu__menuName ">  {{ \Auth::user()->name }}</li> 
                            <li class="userSection__userMenu__menuItem glyphicon glyphicon-th-list"><a href="/history">ประวัติการจอง</a></li>
                            {{-- <li class="userSection__userMenu__menuItem glyphicon glyphicon-edit"><a href="#">แก้ไขข้อมูล</a></li> --}}
                            <li class="userSection__userMenu__menuItem glyphicon glyphicon-log-out"><a href="/signout">ออกจากระบบ</a></li>
                        </ul>
                    </div>
                    @endif
                <!--User active end-->           
            </div>
        </div>
    </header>
    <!--header start end-->


    @yield('breadcrumbs')
    <div class="container">
        @yield('content')
    </div>

    @yield('description')



    <!--small footer start -->
    <footer class="footer-small">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 pull-right">
                    <ul class="social-link-footer list-unstyled">
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="https://www.facebook.com/jjgreen59/?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a></li>

                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="https://twitter.com/?lang=th" target="_blank"><i class="fa fa-twitter"></i></a></li>

                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".8s"><a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="copyright">
                        <p>&copy;  2558 - 13540189 - ICT - SILPAKORN</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--small footer end-->

<script type="text/javascript" src="{{  asset('/js/hover-dropdown.js') }}">
</script>
<script defer src="{{  asset('/js/jquery.flexslider.js') }}">
</script>
<script type="text/javascript" src="{{  asset('/assets/bxslider/jquery.bxslider.js') }}">
</script>

<script type="text/javascript" src="{{  asset('/js/jquery.parallax-1.1.3.js') }}">
</script>
<script src="{{  asset('/js/wow.min.js') }}"></script>
<script src="{{  asset('/assets/owlcarousel/owl.carousel.js') }}"></script>

<script src="{{  asset('/js/jquery.easing.min.js') }}">
</script>
<script src="{{  asset('/js/link-hover.js') }}">
</script>
<script src="{{  asset('/js/superfish.js') }}">
</script>
<script type="text/javascript" src="{{  asset('/js/parallax-slider/jquery.cslider.js') }}">
</script>
<script type="text/javascript">
    $(function () {

        $('#da-slider').cslider({
            autoplay: true,
            bgincrement: 100
        });

    });
</script>


<!--common script for all pages-->
<script src="{{  asset('js/common-scripts.js') }}">
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {


        $('.bxslider1').bxSlider({
            minSlides: 5,
            maxSlides: 6,
            slideWidth: 360,
            slideMargin: 2,
            moveSlides: 1,
            responsive: true,
            nextSelector: '#slider-next',
            prevSelector: '#slider-prev',
            nextText: 'Onward →',
            prevText: '← Go back'
        });

    });


</script>


<script>
    $('a.info').tooltip();

    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });

    $(document).ready(function () {

        $("#owl-demo").owlCarousel({

            items: 4

        });

    });

    jQuery(document).ready(function () {
        jQuery('ul.superfish').superfish();
    });

    new WOW().init();


</script>
<script src="{{  asset('/js/app.js') }}"></script>
@yield('script')
</body>
</html>
