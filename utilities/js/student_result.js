const app = angular.module('result_portal', []);
app.controller('result_control', function ($scope, $http, $window) {
    $scope.form = {};
    $scope.display = false;
    $scope.input = true;
    $scope.empty = false;
    $scope.student = {};
    const config = {
        headers: {
            'Content-Type': 'application/json'
        }
    };
    $scope.getResult = function(){
        let afterGet = function(res){
            // if (res.data !== "") {
                if (res.data.student == undefined) {
                    
                    if (res.data.declare == undefined) {
                        if (res.data.result) {
                            $scope.result = JSON.parse(res.data.result);
                        }
                        if (res.data.class_info) {
                            $scope.class_id = res.data.class_info;
                        }
                        $scope.studentData = res.data;
                        $scope.student = {};
                        $scope.display = true;
                        $scope.input = false;
                        $scope.empty = false;
                        $scope.getClass();
                    } else {
                        $scope.empty = true;
                    }

                } else {
                    $scope.info = true;
                }    
            // } else {
            //     $scope.empty = true;
            // }
        };
        $http.post('student_display_result.php', $scope.student, config).then(afterGet);
    };
    $scope.getClass = function(){
        let afterClass = function(res){
            if (res.data !== "") {
                if (res.data.class !== undefined) {
                    $scope.class = res.data.class;
                }    
            } else {
                $scope.empty = true;
            }
        };
        $http.post('student_display_result.php', {class_id:$scope.class_id}, config).then(afterClass);
    };
    // $scope.submitForm = function (event) {
    //     // Prevent form submission on Enter key
    //     event.preventDefault();

    //     // Your form submission logic goes here
    //     console.log('Form submitted');
    //   };
    $scope.reset = function () {    
        $scope.input = true;
        $scope.display = false;
        $scope.form.result.$setPristine();
        $scope.form.result.$setUntouched();
      };
});