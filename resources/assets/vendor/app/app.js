angular.module("myApp",["ui.bootstrap"])
.config(["$interpolateProvider", function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
 }]);