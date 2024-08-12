var app = angular.module('Register', []);
app.controller('Register_control', function($scope, $http, $timeout){
	$scope.user = {};
	$scope.form = {};

	$scope.add = false;
	$scope.fail = false;

	$scope.pInputType = 'password';
	$scope.cInputType = 'password';
	$scope.pEye = 'fa-regular far fa-eye-slash';
	$scope.cEye = 'fa-regular far fa-eye-slash';
	$scope.pViewPass = function () {
		if ($scope.user.pass != ' ' || $scope.user.pass != null) {
			if ($scope.pInputType == 'password') {
				$scope.pInputType = 'text';
				$scope.pEye = "fa-regular far fa-eye";
			} else {
				$scope.pInputType = 'password';
				$scope.pEye = 'fa-regular far fa-eye-slash';
			}
		}
	};
	$scope.cViewPass = function(){ 
		if ($scope.user.cpass != ' ' || $scope.user.cpass != null) {
				if ($scope.cInputType == 'password') {
					$scope.cInputType = 'text';
					$scope.cEye = "fa-regular far fa-eye";
				} else {
					$scope.cInputType = 'password';
					$scope.cEye = 'fa-regular far fa-eye-slash';
				}
			}
	};

	$scope.checkPasswordStrength = function () {
        var password = $scope.user.pass;
		if(password.length > 0){
			var result = zxcvbn(password);
			$scope.passwordStrength = result;
		}
      };

	$scope.getPasswordStrengthStyle = function () {
		if (!$scope.passwordStrength) {
		return {};
		}
		var score = $scope.passwordStrength.score;

		if (score === 0 || score === 1) {
			$scope.strength = 'weak';
			$scope.form.register_user.pass.$setValidity('weakPassword', false);
		} else if (score === 2 || score === 3) {
			$scope.strength = 'fair';
			$scope.form.register_user.pass.$setValidity('weakPassword', true);
		} else {
			$scope.strength = 'strong';
			$scope.form.register_user.pass.$setValidity('weakPassword', true);
		}

	};

	$scope.addUser = function(){
		var afterAdd = function(res){
			// console.log(res);

			if (res.data.add === "yes") {
				$scope.add = true;
				$scope.fail = false;
				$scope.user = {};
				$scope.form.register_user.$setPristine();
				$scope.form.register_user.$setUntouched();
				$timeout(function(){
					window.location.reload();
				}, 2000);
			} else {
				$scope.add = false;
				$scope.fail = true;
			}
		};
		$http.post("admin_register.php", $scope.user, {headers:{'Content-Type': 'application/json'}}).then(afterAdd);
	};
});

 var compareTo = function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function (scope, element, attributes, ngModel) {
            ngModel.$validators.compareTo = function (modelValue, viewValue) {
				if (viewValue) {
					return modelValue == scope.otherModelValue;
				}
				return true;
            };

            scope.$watch('otherModelValue', function () {
                ngModel.$validate();
            });
        }
    };
};
app.directive("compareTo",compareTo);

let validateUsername = function ($http, $q) {
	return {
		require: 'ngModel',
		link: function (scope, element, attrs, ctrl) {
			ctrl.$validators.usernameExist = function (modelValue, viewValue) {
				let name = viewValue;
				let data = {name:name};
				let afterName = function(res){
					// console.log(res.data);
					if (res.data?.userExist !== undefined) {
						if (res.data.userExist === 'yes') {
							ctrl.$setValidity('usernameExist', false);
						} else if (res.data.userExist === '') {
							ctrl.$setValidity('usernameExist', true);
						}
					}
				}
				$http.post('name_exists.php', data,  {headers:{'Content-Type': 'application/json'}}).then(afterName);
				return true;
			};

			ctrl.$validators.usernamePattern = function (modelValue, viewValue) {
				var pattern = /^[a-zA-Z0-9_.]+$/;

				
					if (viewValue && viewValue.length >= 2) {
						return pattern.test(viewValue);
					}
				return true;
			};

			ctrl.$validators.usernamePattern2 = function (modelValue, viewValue) {
				var pattern2 = /[a-zA-Z]/;

				if (viewValue && viewValue.length >= 1) {
					let startLetter = 0;
					return pattern2.test(viewValue.charAt(startLetter));
				}
				return true;
			};

			ctrl.$validators.usernamePattern3 = function (modelValue, viewValue) {
				var pattern3 = /[^\.]/;

				// Check if the input has at least 3 characters before validating
				if (viewValue && viewValue.length >= 2) {
					let endLetter = viewValue.length - 1;
					return pattern3.test(viewValue.charAt(endLetter));
				}

				// Consider empty or short input as valid
				return true;
			};

			// Watch for changes and trigger validation
			scope.$watch(attrs.ngModel, function () {
				ctrl.$validate();
			});
		}
	};
};
app.directive('validateUsername', ['$http','$q', validateUsername]);
