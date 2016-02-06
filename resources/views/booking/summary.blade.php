@extends('welcome')
@section('title', 'Summary')
@section('style')
    <style type="text/css">
        .lock-number {
            width: 90px;
            height: 90px;
            padding: 10px;
            padding-top: 25px;
            margin-top: 0;
            vertical-align: middle;
            border: 1px solid #ccc;
            text-align: center;
            background: #fff;
        }

        .media-body {
            padding: 15px;
        }

        .row.buttom {
            margin-top: 20px;
        }

        .media {
            padding-left: 20%;
        }

        .row.buttom.last {
            margin-top: 20px;
            margin-bottom: 50px;
        }

        p {
            line-height: 1.4em;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1>จองพื้นที่</h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                        <li class="active">จองพื้นที่</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2" ng-controller="SummaryController">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <p><strong>เช่าล๊อคของวันที่ : </strong>
                        <% date | date:'EEEE dd MMMM y' %>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 right">
                    @if(isset($booking) && isset($user))
                    <p><strong>ชื่อสินค้า : </strong>{{ $booking->productName }} </p>
                    <p><strong>ชื่อผู้จอง : </strong> {{ $user->name }}</p>
                    <p><strong>ที่อยู่ : </strong>{{ $user->address }} </p>
                    @endif
                </div>
            </div>

        @if(isset($detail))
                @foreach ($detail as $obj)
                    <div class="media">
                        <div class="media-left">
                            <h2 class="lock-number">{{  $obj->zoneNumber }}</h2>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">โซน {{ $detail->zoneName }}</h4>
                            ราคา {{ number_format($obj->price, 2, '.', '') }} บาท
                            จำนวน 1 ล็อค <br>
                            {{ $booking->type == 1 ? "ชำระผ่านการโอน" : "ชำระ ณ วันขายสินค้า" }}
                        </div>
                    </div>
                @endforeach

                <div class="row buttom">
                    <div class="col-sm-6 text-left"><p><strong>จำนวนรวม : </strong>{{ count($detail) }} ล็อค</p></div>
                    <div class="col-sm-6 text-right"><p><strong>ราคารวม
                                : </strong>{{number_format($booking->totalPrice, 2, '.', '')   }} บาท</p></div>
                </div>

                <div class="row buttom last">
                    <div class="col-sm-6 col-sm-offset-2">
                        <button class="btn btn-success btn-block" ng-click="backToBooking()">กลับสู่หน้าจอง</button>
                    </div>
                </div>

        @endif
        </div>

    </div>

@endsection


@section('script')
    <script type="text/javascript">
       /* var backToBooking = function () {
            window.location = '/booking';
        }*/
        angular.module("myApp").controller('SummaryController', ['$scope', '$http', function ($scope, $http) {

            $scope.date = {{ isset($booking->miliseconds) ? $booking->miliseconds: '""' }} ;
            $scope.backToBooking = function(){
                window.location = '/booking';
            }

        }]);


    </script>



@endsection