const app = angular.module('dashboard', []);
app.controller('board_control', function ($scope, $http, $location, $window) {
    const config = {
        headers: {
            'Content-Type': 'application/json'
        }
    };
    $scope.getData = function(){
        let afterGet = function(res){
            console.log(res.data);
            $scope.whole = parseInt(res.data.whole);
            $scope.classes = res.data.classes;
            $scope.num = ()=> Object.keys($scope.classes).length;
        };
        $http.get('dashboard_logic.php',config).then(afterGet);
    };
    $scope.viewClass = function(x,y){
        // let afterClass = function(res){
        //     // console.log(res);
        //     $window.location.href = "ViewClassData.php";
        // };
        // $http.post('ViewClassData.php', {class_id:x}, {headers:{'Content-Type': 'application/json'}}).then(afterClass);
        let encodedData = encodeURIComponent(x);
        let encodedData2 = encodeURIComponent(y);
          // Redirect to page2.html with the encoded data as a query parameter
        //   $location.replace();
        //   $location.path('/College/ViewCLassData.php').search('data', encodedData);
        $window.location.href = 'viewClassData.php?class_id=' + encodedData + '&className=' + encodedData2;
        // $http.post('getClassData.php', {class_id:x}, {headers:{'Content-Type': 'application/json'}}).then(afterClass);
    };
    $scope.getData();
    // $scope.streamsInfo = function(){
    //     let afterInfo = function(res){
    //         console.log(res.data);
    //         // $scope.whole = res.data.whole;
    //         // $scope.classes = res.data.classes;
    //         $scope.science = parseInt(res.data.science);
    //         $scope.commerce = parseInt(res.data.commerce);
    //         $scope.arts = parseInt(res.data.arts);
    //     };
    //     $http.get('streams.php',config).then(afterInfo);
    // };
    // $scope.streamsInfo();
    // $scope.percent = function(){
    //     const data = {};
    //     if ($scope.science > 0) {
    //     //    return ($scope.science/$scope.whole) * 100;
    //         data['science'] = ($scope.science/$scope.whole) * 100;
    //     }
        
    //     if ($scope.commerce > 0) {
    //         data['commerce'] = ($scope.commerce/$scope.whole) * 100;             
    //      }
        
    //      if ($scope.arts > 0) {
    //          data['arts'] = ($scope.arts/$scope.whole) * 100;             
    //       }
    //      return data;
    // };
});