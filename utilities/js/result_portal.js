const app = angular.module('result_portal', []);
app.controller('result_control', function ($scope, $http, $window) {
    const config = {
        headers: {
            'Content-Type': 'application/json'
        }
    };
    $scope.getData = function(){
        let afterGet = function(res){
            // console.log(res.data);
            $scope.classes = res.data.classes;
        };
        $http.get('dashboard_logic.php',config).then(afterGet);
    };
    $scope.addResult = function(id, className){
        let encodedData = encodeURIComponent(id);
        let encodedData2 = encodeURIComponent(className);
        $window.location.href = 'add_result.php?class_id=' + encodedData +'&className='+encodedData2;
    };
    $scope.viewResult = function(id){
        let encodedData = encodeURIComponent(id);
        $window.location.href = 'view_result.php?class_id='+ encodedData;
    };
    $scope.getData();

});