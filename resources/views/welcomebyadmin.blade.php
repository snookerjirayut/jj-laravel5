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

    <style type="text/css">
    html, body {
      height: 100%;
    }
    .container.body{
        min-height: 70%;
        position: relative;
    }
    .footer-small{
        width:100%;
        position: relative;
        bottom: 0;
        left: 0;

    }
    </style>

</head>
<body>
   

    @yield('breadcrumbs')
    <div class="container body">
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
                        <p>&copy; Copyright - 13540189.ICT@SU</p>
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
