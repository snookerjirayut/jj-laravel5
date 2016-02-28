@extends('backlayout')
@section('title' , 'Manage')
@section('style')
    <style type="text/css">
        .select-booking-date {
            min-width: 150px;
        }

        .table {
            margin-top: 20px;
        }

        .form-group label {
            margin-left: 10px;
        }

        thead tr td {
            font-weight: bold;
        }
    </style>

@endsection
@section('content')

    <section ng-controller="ManageController" ng-init="init()">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>จัดการข้อมูล</h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <td width=5% >ลำดับ</td>
                            <td width=15%>วันที่</td>
                            <td width=25%>จำนวนการจอง</td>
                            <td width=25%>จำนวนเช็คอิน</td>
                            <td width=25%>จำนวนที่ยังไม่เช็คอิน</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="obj in table">
                            <td><% $index+1 %></td>
                            <td><% obj.opened_at %></td>
                            <td><% obj.booking %></td>
                            <td><% obj.checkin %></td>
                            <td><% obj.undefine %></td>
                            <td>
                                
                                <button ng-click="clear(obj.opened_at)"><i class="glyphicon glyphicon-trash"></i> </button>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="row">
                    <div class="col-sm-12">
                        <uib-pagination total-items="input.total" ng-model="input.page"
                                        items-per-page="input.pageSize"
                                        ng-change="pageChanged()"></uib-pagination>
                        <p>จำนวนแถว : <% input.total %></p>
                    </div>
                </div>


            </div>
        </div>


    </section>

@endsection

@section('script')
    <script>
        angular.module("myApp").controller('ManageController', ['$scope', '$http', function ($scope, $http) {
            $scope.list = {};
            $scope.input = {};
            $scope.input.total = 0;
            $scope.input.page = 1;
            $scope.input.pageSize = 20;

            $scope.table = [];

            $scope.init = function () {
                $http.post(' {{url('/admin/manage/get')}} ', $scope.input).success(function (d) {
                    if (d.result) {
                        console.log(d);
                        $scope.input.total = d.total;
                        $scope.table = d.data;
                    }
                });
            }

            $scope.pageChanged = function(){
                $http.post(' {{url('/admin/manage/get')}} ', $scope.input).success(function (d) {
                    if (d.result) {
                        console.log(d);
                        $scope.input.total = d.total;
                        $scope.table = d.data;
                    }
                });
            }

            $scope.clear = function(open){
                if(!open) return alert('Open day can not define.');
                $http.get(' {{url('/admin/manage/clear')}}/'+open).success(function(d){
                    if (d.result) {
                        alert('ลบเรียบร้อยแล้ว');
                        $scope.pageChanged();
                    }
                });
            }
            


        }]);


    </script>

@endsection