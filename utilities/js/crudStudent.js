var app = angular.module("studentCRUD", []);
app.controller("CRUDControl", function($scope, $http, $timeout){
    $scope.student = {};
    $scope.read = true;
    $scope.edit = false;
    // $scope.hello = "hello";
	$scope.fail = false;
	$scope.success = false;
	$scope.delete = false;
	$scope.noDelete = false;
    $scope.selectThis = function(num){
        let afterSelect = function(res){
            // console.log(res.data);
            $scope.student.fName = res.data.first_name;
            $scope.student.mName = res.data.middle_name;
            $scope.student.lName = res.data.last_name;
            $scope.student.dob = new Date(res.data.birth_date);
            $scope.student.phone = res.data.phone;
            $scope.student.email = res.data.email;
            $scope.student.address = res.data.address;
            $scope.student.reg_no = res.data.reg_no;
            $scope.edit = true;
            $scope.read = false;
        };
        $http.post('selectThis.php', {num:num}, {headers:{'Content-Type': 'application/json'}}).then(afterSelect);
    };
	$scope.classes = function(){
		let afterClass = function(res){
			if (res.data.class) {
				$scope.class = res.data.class;
			}
		}
		$http.get('add_student.php').then(afterClass);
	};
    $scope.editUser = function(){
        let afterEdit = function(res){
			// console.log(res);

			if (res.data.edit === "yes") {

				$scope.fail = false;
				$scope.success = true;
				$scope.student = {};
				$scope.form.admission_portal.$setPristine();
				$scope.form.admission_portal.$setUntouched();
				$timeout(function(){
					window.location.reload();
				}, 2500);
			} else  if (res.data.edit === "") {

				$scope.fail = true;
				$scope.success = false;
			}
		};
		$http.post("editStudent.php",$scope.student).then(afterEdit);
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
			$http.post('deleteThis.php', {num:num}, {headers:{'Content-Type': 'application/json'}}).then(afterDelete);	
		}
	};
    $scope.reset = function(){
        $scope.read = true;
        $scope.edit = false;
    };
});

let validateName = function () {
	return {
		require: 'ngModel',
		link: function (scope, element, attrs, ctrl) {
			ctrl.$validators.namePattern = function (modelValue, viewValue) {
				let pattern = /^[a-zA-Z]+$/;
				if (viewValue && viewValue.length >= 1) {
					return pattern.test(viewValue)
				}
				return true;
			};

			// Watch for changes and trigger validation
			scope.$watch(attrs.ngModel, function () {
				ctrl.$validate();
			});
		}
	};
};
app.directive('validateName', [validateName]);

let validateDetails = function ($http) {
	return {
		require: 'ngModel',
		link: function (scope, element, attrs, ctrl) {
			ctrl.$validators.phoneExist = function (modelValue, viewValue) {
				let phone = viewValue;
				let data = {mobile:phone, reg_no:scope.student.reg_no};
				let afterPhone = function(res){
					// console.log(res.data);
					if (res.data && res.data.mobile !== undefined) {
						if (res.data.mobile === 'yes') {
							ctrl.$setValidity('phoneExist', false);
						} else if (res.data.mobile === '') {
							ctrl.$setValidity('phoneExist', true);
						}
					}
				}
				$http.post('addStudentValidators.php', data,  {headers:{'Content-Type': 'application/json'}}).then(afterPhone);
				return true;
			};
			ctrl.$validators.emailExist = function (modelValue, viewValue) {
				let email = viewValue;
				let data = {e_mail:email, reg_no:scope.student.reg_no};
				let afterEmail = function(res){
					// console.log(res.data);
					if (res.data && res.data.e_mail !== undefined) {
						if (res.data.e_mail === 'yes') {
							ctrl.$setValidity('emailExist', false);
						} else if (res.data.e_mail === '') {
							ctrl.$setValidity('emailExist', true);
						}
					}
				}
				$http.post('addStudentValidators.php', data,  {headers:{'Content-Type': 'application/json'}}).then(afterEmail);
				return true;
			};

			// Watch for changes and trigger validation
			scope.$watch(attrs.ngModel, function () {
				ctrl.$validate();
			});
		}
	};
};
app.directive('validateDetails', ['$http',validateDetails]);