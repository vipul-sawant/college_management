const app = angular.module('add_result', []);
app.controller('add_result_control', function ($scope, $http, $window, $location, $timeout) {
    const config = {
        headers: {
            'Content-Type': 'application/json'
        }
    };

    const requestData = $window.location.href;
    const requestDataSplit = requestData.split('?');
    const params = requestDataSplit[1];
    const values = params.split('&');
    // console.log(values);
    const entries = values[0].split('=');
    console.log(entries);
    let obj = {};
    obj[entries[0]] = entries[1];
    $scope.class_id = obj.class_id;

    $scope.add = false;
    $scope.noAdd = false;
    // console.log($scope.class_id);
    if ($scope.class_id == 11 || $scope.class_id == 12) {
        $scope.student = {english:0, maths:0, physics:0, chemistry:0, biology:0, cs:0};   
    } else if ($scope.class_id == 13 || $scope.class_id == 14) {
        $scope.student = {english:0, maths:0, bk:0, oc:0, economics:0, sp:0};
    } else if ($scope.class_id == 15 || $scope.class_id == 16) {
        $scope.student = {english:0, maths:0, hindi:0, geography:0, history:0, economics:0};
    }
    console.log($scope.student);
    $scope.getData = function(){
        let afterGet = function(res){
            // console.log(res.data);
            // $scope.student.reg_no_s = res.data;
            $scope.reg_no_s = res.data;
            // console.log($scope.reg_no_s);
        };
        $http.get('getStudents.php',{ params: obj }, config).then(afterGet);
    };
    $scope.getData();
    $scope.back = function(){
        $window.location.href = "result_portal.php";
    };
    $scope.total = function(){
        let marks = 0;
        Object.entries($scope.student).forEach(function([key, value]) {
            marks += value;
          });
        //   console.log(score);
          return marks;
    };
    $scope.percent = function(){
        let score = $scope.total() /600 *100;
       return parseFloat(score.toFixed(2));
    };
    $scope.addResult = function(){
        let finalResult = {};
        // console.log($scope.student);
        Object.entries($scope.student).forEach(function([key, value]) {
            finalResult[key] = value;
          });
          finalResult.reg_no = $scope.reg_no;
          finalResult.total = $scope.total();
          finalResult.percent = $scope.percent();
          finalResult.grade = $scope.grades();
        //   console.log(finalResult);
          let afterPost = function(res){
              if (res.data.add === "yes") {
                // $scope.add = true;
                $scope.noAdd = false;
                // if ($scope.class_id == 11 || $scope.class_id == 14) {
                //     $scope.student = {english:0, maths:0, physics:0, chemistry:0, biology:0, cs:0};   
                // } else if ($scope.class_id == 12 || $scope.class_id == 15) {
                //     $scope.student = {english:0, maths:0, bk:0, oc:0, economics:0, sp:0};
                // } else if ($scope.class_id == 13 || $scope.class_id == 16) {
                //     $scope.student = {english:0, maths:0, hindi:0, geography:0, history:0, economics:0};
                // }
                $timeout(function(){
                    console.log($window.location.href);
                    $window.location.href = 'result_portal.php';
                }, 0);
              } else if (res.data.add === "") {
                // $scope.add = false;
                $scope.noAdd = true;
              }
          };
          $http.post('postResult.php', finalResult, config).then(afterPost);
    };
    $scope.grades = function(){
        let percent = Math.floor($scope.percent()/10);
        switch(percent){
            case 4:
                return "E";
            case 5:
                return "D";
            case 6:
                return "C";
            case 7:
                return "B";
            case 8:
            case 9:
            case 10:
                return "A";
            default:
                return "F"
        }
    };
    $scope.grade = $scope.grades();
    console.log($scope.grade);
    $scope.getUrl = function(){
       var pageName = $window.location.href.substring($window.location.href.lastIndexOf('/') + 1);
       if (pageName.includes('?')) {
            let splitValue = pageName.split('?');
            return splitValue[0];
       } else {
       return pageName;
       }
    };
});

let validateResult = function ($http) {
	return {
		require: 'ngModel',
		link: function (scope, element, attrs, ctrl) {
			ctrl.$validators.resultExist = function (modelValue, viewValue) {
				let reg_no = viewValue;
				let data = {reg_no:reg_no};
				let afterRegNo = function(res){
					// console.log(res.data);
					if (res.data?.resultExist !== undefined) {
						if (res.data.resultExist === 'yes') {
							ctrl.$setValidity('resultExist', false);
						} else if (res.data.resultExist === '') {
							ctrl.$setValidity('resultExist', true);
						}
					}
				}
				$http.post('result_exists.php', data,  {headers:{'Content-Type': 'application/json'}}).then(afterRegNo);
				return true;
			};

			// Watch for changes and trigger validation
			scope.$watch(attrs.ngModel, function () {
				ctrl.$validate();
			});
		}
	};
};
app.directive('validateResult', ['$http', validateResult]);