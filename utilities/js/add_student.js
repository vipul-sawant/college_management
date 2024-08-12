var app = angular.module("Admission", []);
app.controller("Admin_control", function($scope, $http, $timeout){
	$scope.student = {};
	$scope.form = {};
	$scope.fail = false;
	$scope.success = false;
	$scope.classes = function(){
		let afterClass = function(res){
			if (res.data.class) {
				$scope.class = res.data.class;
			}
		}
		$http.get('add_student.php').then(afterClass);
	};
	$scope.classDetails = true;
	$scope.add_student = function(){
		console.log('Hello');
		let after_add = function(res){
			// console.log(res);

			if (res.data.insert === "yes") {

				$scope.fail = false;
				$scope.success = true;
				$scope.student = {};
				$scope.form.admission_portal.$setPristine();
				$scope.form.admission_portal.$setUntouched();
				$timeout(function(){
					window.location.reload();
				}, 2500);
			} else  if (res.data.insert === "") {

				$scope.fail = true;
				$scope.success = false;
			}
		};
		$http.post("add_student.php",$scope.student).then(after_add);
	};
	$scope.classes();
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
				let data = {mobile:phone};
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
				let data = {e_mail:email};
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