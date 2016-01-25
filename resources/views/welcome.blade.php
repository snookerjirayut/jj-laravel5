<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <title>Green Vintage - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">

    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/flexslider.css"/>
    <link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="assets/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/owlcarousel/owl.theme.css">

    <link href="css/superfish.css" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="css/component.css">

    <link href="/css/style-member.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/moment/min/moment.min.js"></script>
    <script src="/css/bootstrap/dist/js/bootstrap.js"></script>
    <!-- Angular core JS -->
    <script src="/js/angular/angular.min.js"></script>
    <script src="/js/angular-i18n/angular-locale_th-th.js"></script>
    <script src="/js/angular/ui-bootstrap-tpls.js"></script>


    @yield('style')

</head>
<body>
    <div class="col-sm-12 ">
        <img src="img/header.png" class="img-resposive max-width">
    </div>
    <!--header start-->
    <header class="head-section">
        <div class="navbar navbar-default navbar-static-top container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">GREEN<span>vintage</span></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @if(\Auth::check())
                        <li><a href="/booking">จองพื้นที่</a></li>
                        <li><a href="/checkin">เช็คอิน</a></li>
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
                        <a href="contact.html">ติดต่อเรา</a>
                    </li>
                    <li><input class="form-control search" placeholder=" Search" type="text"></li>
                </ul>
            </div>
        </div>
    </header>
    <!--header start end-->

    @yield('breadcrumbs')
    <div class="container">
        @yield('content')
    </div>

    @yield('description')


            <!--footer start-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4 address wow fadeInUp" data-wow-duration="2s" data-wow-delay=".1s">
                    <h1>
                        เกี่ยวกับ กรีน วินเทจ
                    </h1>
                    <p>
                        Green vintage Night Market ตลาดนัดกลางคืนโฉมใหม่ในทำเลแห่งเก่า กลิ่นไอเดิมๆ ที่ไม่เคยจางหาย บรรยากาศผู้คนที่มากมายตามสายทางเดิน สองข้างทางเต็มไปด้วยบรรยากาศของร้านค้าต่างๆ ในแต่ละโซน กว่าพันร้านค้า ที่มีมาให้ดูให้ชม ให้เลือกให้หา มาหาความสุข สนุกทุกย่างก้าว กับบรรยากาศตลาดนัดกลางคืนที่เจเจกรีน ใกล้กับพิพิธภัณฑ์เด็ก

                    </p>
                </div>

                <div class="col-lg-4 col-sm-4">
                    <div class="page-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".5s">
                        <h1>
                            กรีน วินเทจ
                        </h1>
                        <ul class="page-footer-list">
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="booking.html">จองพื้นที่ขายของ</a>
                            </li>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="checkin.html">เชคอิน</a>
                            </li>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="inform.html">แจ้งโอน</a>
                            </li>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="faq.html">คำถาม</a>
                            </li>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="blog.html">ข่าวสารและกิจกรรม</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="text-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".7s">
                        <h1>
                            ติดต่อเราได้ที่
                        </h1>
                        <address>
                            <p><i class="fa fa-home pr-10"></i> ถนน กำแพงเพชร 3</p>
                            <p><i class="fa fa-globe pr-10"></i>เขตจตุจักร กรุงเทพมหานคร 10900 </p>
                            <p><i class="fa fa-phone pr-10"></i>  086 567 9959 </p>
                            <p><i class="fa fa-envelope pr-10"></i>   <a href="javascript:;">mychappa@gmail.com</a></p>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->


    <!--small footer start -->
    <footer class="footer-small">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 pull-right">
                    <ul class="social-link-footer list-unstyled">
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="#"><i class="fa fa-facebook"></i></a></li>

                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="#"><i class="fa fa-twitter"></i></a></li>

                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".8s"><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="copyright">
                        <p>&copy; Copyright - 13540189.ICT@SU</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--small footer end-->

<script type="text/javascript" src="js/hover-dropdown.js">
</script>
<script defer src="js/jquery.flexslider.js">
</script>
<script type="text/javascript" src="assets/bxslider/jquery.bxslider.js">
</script>

<script type="text/javascript" src="js/jquery.parallax-1.1.3.js">
</script>
<script src="js/wow.min.js">
</script>
<script src="assets/owlcarousel/owl.carousel.js">
</script>

<script src="js/jquery.easing.min.js">
</script>
<script src="js/link-hover.js">
</script>
<script src="js/superfish.js">
</script>
<script type="text/javascript" src="js/parallax-slider/jquery.cslider.js">
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
<script src="js/common-scripts.js">
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
<script src="/js/app.js"></script>
@yield('script')
</body>
</html>
