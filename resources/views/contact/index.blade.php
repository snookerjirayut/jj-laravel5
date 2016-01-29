@extends('welcome')
@section('title', 'Booking')
@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1>ติดต่อเรา</h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                        <li class="active">ติดต่อเรา</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">

        <div class="col-lg-7 col-sm-7 address">

            <div class="contact-form">
                <form role="form">
                    <div class="form-group has-success">
                        <label for="name">
                            ชื่อ - นามสกุล
                        </label>
                        <input type="text" placeholder="" id="name" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <label for="email">
                            Email
                        </label>
                        <input type="text" placeholder="" id="email" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <label for="phone">
                            เบอร์โทรศัพท์
                        </label>
                        <input type="text" id="phone" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <label for="phone">
                            ข้อความ
                        </label>
                <textarea placeholder="" rows="5" class="form-control">
                </textarea>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit">
                        ส่งข้อความ
                    </button>
                </form>

            </div>
        </div>

        <div class="col-lg-5 col-sm-5 address">
            <section class="contact-infos">
                <h4 class="title custom-font text-black">
                    ที่อยู่
                </h4>
                <address>
                    <p><i class="fa fa-home pr-10"></i> ถนน กำแพงเพชร 3</p>
                    <p><i class="fa fa-globe pr-10"></i>เขตจตุจักร กรุงเทพมหานคร 10900 </p>
                    <p><i class="fa fa-envelope pr-10"></i> <a href="javascript:;">mychappa@gmail.com</a></p>
                </address>
            </section>
            <section class="contact-infos">
                <h4 class="title custom-font text-black">
                    เวลาทำการ
                </h4>
                <p>
                    พฤหัสบดี - อาทิตย์ 16:00 - 01.00 น.
                    <br>

                </p>
            </section>
            <section class="contact-infos">
                <h4>
                    เบอร์ติดต่อ
                </h4>
                <p><i class="fa fa-phone pr-10"></i> 086 567 9959 </p>
            </section>
        </div>
    </div>

@endsection
@section('description')
    <div class="contact-map">
        <div id="map-canvas" style="width: 100%; height: 400px">
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&AMP;sensor=false"></script>
    <script>
        $(document).ready(function () {
                    //Set the carousel options
                    $('#quote-carousel').carousel({
                                pause: true,
                                interval: 4000,
                            }
                    );
                }
        );

        //google map
        function initialize() {
            var myLatlng = new google.maps.LatLng(51.508742, -0.120850);
            var mapOptions = {
                zoom: 5,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: 'Contact'
                    }
            );
        }
        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@endsection

