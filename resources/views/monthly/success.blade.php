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
            border: 1px solid #8CC63F;
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

        strong{
            color: #09b06a;
            font-size: 1.2em;
        }
        .summary{
            max-width:70%;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .text-success {
            color: #09b06a;
        }

    </style>
@endsection
@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1>สรุปการจองพื้นที่ แบบรายเดือน</h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                        <li class="active">สรุปการจองพื้นที่ แบบรายเดือน</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
        <h2 class="text-center text-success">ทำรายการสำเร็จ</h2>
        <h2 class="text-center text-success">รหัสการจอง : <span style="color: #AA0000">{{ $booking_code  }}</span></h2>
        <div class="summary">
            <div class="row">
                <h4 class="text-right">ณ วันที่ {{date('Y-m-d H:i:s')}}</h4>
                <h4 class="text-right">รหัสการจอง {{  $booking_code  }}</h4>
                <h3>สินค้า : {{ $productName }} </h3>
                <h3>รายเดือน : {{ $thai_date }} </h3>
                <div class="col-lg-12 col-sm-12" ng-controller="SummaryController">
                    <table class="table ">
                        <tr>
                            <th>ลำดับ</th>
                            <th class="text-center">วันที่</th>
                            <th class="text-center">โซน</th>
                            <th></th>
                            <th class="text-center">ราคา/ล็อค</th>
                            <th class="text-center">ราคา</th>
                        </tr>
                        <?php $index = 1 ; ?>
                        @foreach($rows as $row)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $row->thaidate }}</td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    {{ str_replace(  '|' , ',' , $products) }}
                                </td>
                                <td class="text-center">{{  $row->price_type2 }}</td>
                                <td class="text-center">{{ $row->price }}</td>
                            </tr><?php $index++ ?>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-right">รวมราคา</td>
                            <td> <h4>{{ number_format($total_price) }}</h4></td>
                        </tr>
                    </table>

                </div>
                <div class="col-sm-6 col-sm-offset-4">
                        @if(isset($type))
                            @if($type == 1 ) <h4  class="text-success text-center">รูปแบบการชำระเงิน : ชำระผ่านธนาคาร</h4>
                            @elseif ($type == 2 ) <h4 class="text-success text-center">รูปแบบการชำระเงิน : ชำระ ณ วันที่ขายสินค้า</h4>
                            @endif
                        @endif

                </div>

                <div class="col-sm-8 col-sm-offset-2 box-booking-button">
                    <a class="btn btn-jj btn-block" href="/" >กลับสู้หน้าหลัก</a>
                </div>
            </div>


        </div>



@endsection


@section('script')
    <script type="text/javascript">
        /* var backToBooking = function () {
         window.location = '/booking';
         }*/
        angular.module("myApp").controller('SummaryController', ['$scope', '$http', function ($scope, $http) {
            var date = new Date();
            date.setFullYear( date.getFullYear() + 543 );
            $scope.date =  date;
            $scope.backToBooking = function(){
                window.location = "/booking";
            }

            $scope.booking = function(){
                alert('booking');
            }

        }]);


    </script>



@endsection