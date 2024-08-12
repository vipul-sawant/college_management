var app = angular.module('Login', []);
app.controller('Login_control', function($scope, $http, $window, $location){
	$scope.user = {};
	$scope.form = {};

	$scope.wrong_uname = false;
	$scope.wrong_pass = false;

	$scope.inputType = 'password';
	$scope.eye = 'fa-regular far fa-eye-slash';
	$scope.view_pass = function () {
	 if ($scope.pass_word != ' ' || $scope.pass_word != null) {
	 	if ($scope.inputType == 'password') {
			$scope.eye = 'fa-regular far fa-eye';
	 		$scope.inputType = 'text';
	 	} else {
	 		$scope.inputType = 'password';
			$scope.eye = 'fa-regular far fa-eye-slash';
	 	}
	 }
	};

	$scope.log_user = function(){
		console.log('log_user');
		var after_login = function(res){
			console.log(res.data);
			if (res.data.uname == "yes") {
				$scope.wrong_uname = true;
				$scope.wrong_pass = false;
			} else if (res.data.pass == "yes") {
				$scope.wrong_uname = false;
				$scope.wrong_pass = true;
			} else {
				$scope.wrong_uname = false;
				$scope.wrong_pass = false;
				$window.location.href = "/johnjrcollege/backend/new_dashboard.php";
			}
		};
		$http.post("admin_login.php",$scope.user).then(after_login);
	};
});