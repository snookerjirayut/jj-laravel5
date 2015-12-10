angular.module("myApp",[])
.config(["$interpolateProvider", function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
 }]);