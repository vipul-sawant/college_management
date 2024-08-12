var app = angular.module("studentCRUD", []);
app.controller("CRUDControl", function($scope, $window, $http, $timeout){
    $scope.student = {};

    $scope.read = true;
    $scope.edit = false;

	$scope.fail = false;
	$scope.success = false;
	$scope.delete = false;
	$scope.noDelete = false;

    const config = {
        headers: {
            'Content-Type': 'application/json'
        }
    };

    const requestData = $window.location.href;
    const requestDataSplit = requestData.split('?');
    const params = requestDataSplit[1];
    const values = params.split('=');
    let obj = {};
    obj[values[0]] = values[1];
    $scope.class_id = obj.class_id;

    if ($scope.class_id == 11 || $scope.class_id == 14) {
        $scope.student = {english:0, maths:0, physics:0, chemistry:0, biology:0, cs:0};   
    } else if ($scope.class_id == 12 || $scope.class_id == 15) {
        $scope.student = {english:0, maths:0, bk:0, oc:0, economics:0, sp:0};
    } else if ($scope.class_id == 13 || $scope.class_id == 16) {
        $scope.student = {english:0, maths:0, hindi:0, geography:0, history:0, economics:0};
    }
	// console.log($scope.student);
    $scope.selectThis = function(num){
        let afterSelect = function(res){
            // console.log(res.data);
            // $scope.student.fName = res.data.first_name;
            // $scope.student.mName = res.data.middle_name;
            // $scope.student.lName = res.data.last_name;
            // $scope.student.dob = new Date(res.data.birth_date);
            // $scope.student.phone = res.data.phone;
            // $scope.student.email = res.data.email;
            // $scope.student.address = res.data.address;
            $scope.reg_no = res.data.reg_no;
			$scope.shortcut(res);
            $scope.edit = true;
            $scope.read = false;
        };
        $http.post('selectThis.php', {no:num}, {headers:{'Content-Type': 'application/json'}}).then(afterSelect);
    };
	$scope.shortcut = function(res){
		let x = {};
		// console.log(x);
		// let z = JSON.parse(res.data);
		let z = res.data;
		for (let j in z) {
			// console.log(j);
				// console.log(j);
				// console.log(x);
			if (j != "percent" && j != "total" && j != "reg_no" && j != "grade") {
				x[j] = res.data[j];	
			}
		}
		
		// console.log(x);
		$scope.student = x;
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
        // $scope.grade = $scope.grades();
       return parseFloat(score.toFixed(2));
    };
    $scope.editMarks = function(){
		let finalResult = {};
		// console.log($scope.student);
		Object.entries($scope.student).forEach(function([key, value]) {
			finalResult[key] = value;
		});
		finalResult.reg_no = $scope.reg_no;
		finalResult.total = $scope.total();
		finalResult.percent = $scope.percent();
		finalResult.grade = $scope.grades();
		// console.log(finalResult);

        let afterEdit = function(res){
			// console.log(res);

			if (res.data.edit === "yes") {

				$scope.fail = false;
				$scope.success = true;
				if ($scope.class_id == 11 || $scope.class_id == 14) {
					$scope.student = {english:0, maths:0, physics:0, chemistry:0, biology:0, cs:0};   
				} else if ($scope.class_id == 12 || $scope.class_id == 15) {
					$scope.student = {english:0, maths:0, bk:0, oc:0, economics:0, sp:0};
				} else if ($scope.class_id == 13 || $scope.class_id == 16) {
					$scope.student = {english:0, maths:0, hindi:0, geography:0, history:0, economics:0};
				}
				// $scope.form.admission_portal.$setPristine();
				// $scope.form.admission_portal.$setUntouched();
				$timeout(function(){
					window.location.reload();
					$scope.read = true;
					$scope.edit = false;
				}, 5000);
			} else  if (res.data.edit === "") {

				$scope.fail = true;
				$scope.success = false;
			}
		};
		$http.post("editMarks.php", finalResult, config).then(afterEdit);
    };
	$scope.deleteThis = function(num){
		let afterDelete = function(res){
			// console.log(res);

			if (res.data.delete === "yes") {

				$scope.delete = true;
				$scope.noDelete = false;
				$timeout(function(){
					window.location.reload();
				}, 2500);
			} else  if (res.data.delete === "") {
				$scope.delete = false;
				$scope.noDelete = true;
			}
		};
		if (confirm("Are you sure you want to delete it?")) {
			$http.post('deleteThis.php', {no:num}, {headers:{'Content-Type': 'application/json'}}).then(afterDelete);	
		}
	};
    $scope.reset = function(){
        $scope.read = true;
        $scope.edit = false;
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
    // $scope.grade = $scope.grades();
});