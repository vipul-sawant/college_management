<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js" integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- <script src="../angular-1.8.2/angular.min.js"></script> -->
    <link rel="stylesheet" href="../utilities/css/basics.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title> Add Result </title>
</head>
<body>
    <!-- <div ng-app="add_result" ng-controller="add_result_control" class="d-flex" id="container">
        <div ng-include="'sidebar.php'" id="sidebar" class="sidebar d-flex flex-column"></div>
			<div id="content" class="d-flex justify-content-center flex-fill">
            <form method="post" action="" name="form.addmission_portal" ng-submit="form.addmission_portal.$valid && addResult()" novalidate style="max-width: 250px;">
                <div class="row">
                <div class="col-lg-2">
                    <label for="reg_no">Reg. No. :-</label>
                </div>
                <div class="col-lg-3">
                    <select name="reg_no" id="reg_no" ng-model = "reg_no" validate-result required>
                        <option value="" selected>--------</option>
                        <option ng-repeat="item in reg_no_s" value="{{item}}">{{item}}</option>
                    </select>
                </div>
                <div class="col-lg-7">
                    <p ng-show = "(form.addmission_portal.$submitted || form.addmission_portal.reg_no.$dirty) && form.addmission_portal.reg_no.$error.required">
                        Please Select a Student.
                    </p>
                    <p ng-show = "reg_no_s.length === 0">
                        All Result Declared.
                    </p>
                </div>
                </div>
                <div class="row">
                <div class="col-lg-2">
                    <label for="english">English :</label>
                </div>
                <div class="col-lg-3">
                    <input type="number" id="english" name="english"  ng-model = "student.english" ng-min="0" ng-max="100"  required />
                </div>
                <div class="col-lg-7">
                    <p ng-show = "(form.addmission_portal.$submitted || form.addmission_portal.english.$dirty) && form.addmission_portal.english.$error.required">
                        Please Enter English Marks.
                    </p>

                    <p ng-show = " form.addmission_portal.english.$dirty && form.addmission_portal.english.$error.min">
                        Minimum 0.
                    </p>

                    <p ng-show = " form.addmission_portal.english.$dirty && form.addmission_portal.english.$error.max">
                        Maximum 100.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <label for="maths">Maths :</label>
                </div>
                <div class="col-lg-3">
                    <input type="number" id="maths" name="maths"  ng-model = "student.maths" ng-min="0" ng-max="100"  required />
                </div>
                <div class="col-lg-7">
                    <p ng-show = "(form.addmission_portal.$submitted || form.addmission_portal.maths.$dirty) && form.addmission_portal.maths.$error.required">
                        Please Enter English Marks.
                    </p>

                    <p ng-show = " form.addmission_portal.maths.$dirty && form.addmission_portal.maths.$error.min">
                        Minimum 0.
                    </p>

                    <p ng-show = " form.addmission_portal.maths.$dirty && form.addmission_portal.maths.$error.max">
                        Maximum 100.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <label for="total">Total (out of 600) :</label>
                </div>
                <div class="col-lg-3">
                    <input type="number" id="total" name="total" value="{{total()}}" disabled required />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <label for="percent"> Percentage (%) :</label>
                </div>
                <div class="col-lg-3">
                    <input type="number" id="percent" name="percent" value="{{percent()}}" disabled required />
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2">
                    <label for="grade"> Grade :</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" id="grade" name="grade" value="{{grades()}}" disabled required />
                </div>
            </div>
            <div ng-if="reg_no && !form.addmission_portal.reg_no.$error.resultExist">
                <button type="button" ng-click="form.addmission_portal.$valid && addResult()">Add</button>
            </div>

            <div ng-if="reg_no && form.addmission_portal.reg_no.$erorr.resultExist===undefined">
                <button>Add</button>
            </div>
        
        <p ng-show="add">Marks Added Successfully.</p>
        <p ng-show="notAdd">Could not Add Marks.</p>
        
        <button type="button" ng-click="back()">Back</button>
            </form>
        <p>Form Valid : {{form.addmission_portal.$valid}}</p>
        
        <p>Result : {{form.addmission_portal.reg_no.$error}}</p>
        <p> reg_no_s {{reg_no_s}} </p>
</div>
    </div> -->
    
		<div ng-app = "add_result" ng-controller = "add_result_control" class="d-flex" id="container">
			<div ng-include="'sidebar.php'" id="sidebar" class="sidebar d-flex flex-column"></div>
			<div id="content" class="flex-fill d-flex justify-content-center align-items-center">
				<form method="post" action="" name="form.addmission_portal" novalidate id="admissionForm" style="width:var(--form);margin: 0px auto;">
                <!-- <p>{{form.addmission_portal.$valid}}</p> -->
					<h1 class="text-center fw-bolder text-white"> Student Marks</h1>
                    <h2 class="h2 text-center text-white fw-bold"> Class : <?=$_GET['className'];?> </h2>
                    <div class="m-2">
                        <label for="reg_no" class="heading fw-bold">
                        Reg.No. : 
                        </label>
                    </div>
                    <div class="detail_box" ng-class="{'input_error':((form.addmission_portal.reg_no.$dirty || form.addmission_portal.$submitted) && form.addmission_portal.reg_no.$error.required)}">
                        <!-- <p>{{(form.addmission_portal.reg_no.$dirty || form.addmission_portal.$submitted) && form.addmission_portal.reg_no.$error.required}}</p> -->
                        <!-- <div class="col-lg-2"> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-3"> -->
                            <select name="reg_no" id="reg_no" ng-model = "reg_no" validate-result required style="border:none;width:100%;outline:none;" class="detail_input">
                                <option value="" selected>--------</option>
                                <option ng-repeat="item in reg_no_s" value="{{item}}">{{item}}</option>
                            </select>
                        <!-- </div> -->
                        <!-- <p>{{reg_no_s}}</p> -->
                    </div>

                    <div class="m-2">
                        <label for="english" class="heading fw-bold">
                        English : 
                        </label>
                    </div>
                    <div class="detail_box" ng-class="{'input_error':form.addmission_portal.english.$dirty && (form.addmission_portal.english.$error.min || form.addmission_portal.english.$error.max || form.addmission_portal.english.$error.required)}">
                        <input type="number" id="english" name="english"  ng-model = "student.english" ng-min="0" ng-max="100"  required class="detail_input" />
                    </div>

                    <div class="m-2">
                        <label for="maths" class="heading fw-bold">
                        Maths : 
                        </label>
                    </div>
                    <div class="detail_box" ng-class="{'input_error':form.addmission_portal.maths.$dirty && (form.addmission_portal.maths.$error.min || form.addmission_portal.maths.$error.max || form.addmission_portal.maths.$error.required)}">
                    
                    <!-- <div class="col-lg-3"> -->
                        <input type="number" id="maths" name="maths"  ng-model = "student.maths" ng-min="0" ng-max="100"  required class="detail_input" />
                    <!-- </div> -->
                </div>
                <?php
                    require_once('../database/database.php');
                    $data = array();
                    if ($_SERVER['REQUEST_METHOD']==="GET" && isset($_GET['class_id'])) {
                        $classID = intval($_GET['class_id']);

                        if ($classID === 11 || $classID === 12) {?>
                        <div ng-include="'science_form.html'"></div>
                        <?php
                        } else if ($classID === 13 || $classID === 14) {?>
                            <div ng-include="'commerce_form.html'"></div>
                            <?php
                        } else if ($classID === 15 || $classID === 16) {?>
                            <div ng-include="'arts_form.html'"></div>
                            <?php
                        }
                        // $data['class_id']=$classID;
                    }
                    mysqli_close($con);
                ?>
					<!-- <div ng-include="'student_details_form.html'" class="content"></div> -->
					<!-- <button type="submit" id="btn" class="poppins-black back"> Submit </button> -->
                    <div class="m-2">
                    <label for="total" class="heading fw-bold">
                        Total (out of 600) 
                    </label>
                </div>

                <div class="detail_box d-flex m-2">
                    <input type="number" class="detail_input" disabled required id="total" name="total" value="{{total()}}" />
                </div>
        
                <!-- <div class="row">
                    <div class="col-lg-2">
                        <label for="percent"> Percentage (%) :</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="number" id="percent" name="percent" value="{{percent()}}" disabled required />
                    </div>
                </div> -->
                
                <div class="m-2">
                    <label for="percent" class="heading fw-bold">
                    Percentage (%) 
                    </label>
                </div>

                <div class="detail_box d-flex m-2">
                    <input type="number" class="detail_input" disabled required id="percent" name="percent" value="{{percent()}}" />
                </div>
        
                <!-- <div class="row">
                    <div class="col-lg-2">
                        <label for="grade"> Grade :</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" id="grade" name="grade" value="{{grades()}}" disabled required />
                    </div>
                </div> -->

                <div class="m-2">
                    <label for="grade" class="heading fw-bold">
                    Grade : 
                    </label>
                </div>

                <div class="detail_box d-flex m-2">
                    <p class="detail_input m-0" id="grade" name="grade" ng-bind="grades()"></p>
                </div>

                <!-- <div class="d-flex justify-content-center"> -->
                    <!-- <button class=""> Add </button> -->
                    <div ng-if="reg_no_s.length > 0" class="d-flex justify-content-center">
                        <button class="back fw-bolder w-50 m-3" type="button" ng-click="form.addmission_portal.$valid && addResult()">Add</button>
                    </div>
                    <!-- <button type="button" class="back" ng-click="reset()">Reset</button> -->
                <!-- </div> -->
                
                    <div ng-show = "reg_no_s.length === 0" class="error message fw-bold">
                        All Result Declared.
                    </div>

                    <!-- <div>{{class_id}}</div> -->

                    <div ng-if="class_id == 11 || class_id == 12" class="m-3">
                    <p class="weak message" ng-show = "(form.addmission_portal.$submitted || (form.addmission_portal.physics.$dirty || form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.chemistry.$dirty || form.addmission_portal.biology.$dirty || form.addmission_portal.cs.$dirty)) && (form.addmission_portal.physics.$error.required || form.addmission_portal.english.$error.required || form.addmission_portal.maths.$error.required || form.addmission_portal.chemistry.$error.required || form.addmission_portal.biology.$error.required || form.addmission_portal.cs.$error.required)">
                        Please enter fields with red border.
                    </p>

                    <p class="weak message" ng-show = "(form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.physics.$dirty || form.addmission_portal.chemistry.$dirty || form.addmission_portal.biology.$dirty || form.addmission_portal.cs.$dirty) && (form.addmission_portal.english.$error.min || form.addmission_portal.maths.$error.min || form.addmission_portal.physics.$error.min || form.addmission_portal.chemistry.$error.min || form.addmission_portal.biology.$error.min || form.addmission_portal.cs.$error.min)">
                        Minimum marks are 0.
                    </p>

                    <p class="weak message" ng-show = "(form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.physics.$dirty || form.addmission_portal.chemistry.$dirty || form.addmission_portal.biology.$dirty || form.addmission_portal.cs.$dirty) && (form.addmission_portal.english.$error.max || form.addmission_portal.maths.$error.max || form.addmission_portal.physics.$error.max || form.addmission_portal.chemistry.$error.max || form.addmission_portal.biology.$error.max || form.addmission_portal.cs.$error.max)">
                        Maximum marks are 100.
                    </p>
                </div>

                <div ng-if="(class_id == 13 || class_id == 14)" class="m-3">
                    <p class="weak message" ng-show = "(form.addmission_portal.$submitted || (form.addmission_portal.oc.$dirty || form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.bk.$dirty || form.addmission_portal.economics.$dirty || form.addmission_portal.sp.$dirty)) && (form.addmission_portal.english.$error.required || form.addmission_portal.maths.$error.required || form.addmission_portal.bk.$error.required || form.addmission_portal.sp.$error.required || form.addmission_portal.oc.$error.required || form.addmission_portal.economics.$error.required)">
                        Please enter fields with red border.
                    </p>

                    <p class="weak message" ng-show = "(form.addmission_portal.oc.$dirty || form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.bk.$dirty || form.addmission_portal.economics.$dirty || form.addmission_portal.sp.$dirty) && (form.addmission_portal.oc.$error.min || form.addmission_portal.english.$error.min || form.addmission_portal.maths.$error.min || form.addmission_portal.bk.$error.min || form.addmission_portal.economics.$error.min || form.addmission_portal.sp.$error.min)">
                        Minimum marks are 0.
                    </p>

                    <p class="weak message" ng-show = "(form.addmission_portal.oc.$dirty || form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.bk.$dirty || form.addmission_portal.economics.$dirty || form.addmission_portal.sp.$dirty) && (form.addmission_portal.english.$error.max || form.addmission_portal.maths.$error.max || form.addmission_portal.sp.$error.max || form.addmission_portal.oc.$error.max || form.addmission_portal.economics.$error.max || form.addmission_portal.bk.$error.max)">
                        Maximum marks are 100.
                    </p>
                </div>

                <div ng-if="class_id == 15 || class_id == 16" class="m-3">
                    <p class="weak message" ng-show = "(form.addmission_portal.$submitted || (form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.hindi.$dirty || form.addmission_portal.history.$dirty || form.addmission_portal.geography.$dirty || form.addmission_portal.economic.$dirty)) && (form.addmission_portal.english.$error.required || form.addmission_portal.maths.$error.required || form.addmission_portal.hindi.$error.required || form.addmission_portal.history.$error.required || form.addmission_portal.geography.$error.required || form.addmission_portal.economic.$error.required)">
                        Please enter fields with red border.
                    </p>

                    <p class="weak message" ng-show = "(form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.hindi.$dirty || form.addmission_portal.history.$dirty || form.addmission_portal.geography.$dirty || form.addmission_portal.economic.$dirty) && (form.addmission_portal.english.$error.min || form.addmission_portal.maths.$error.min || form.addmission_portal.economics.$error.min || form.addmission_portal.hindi.$error.min || form.addmission_portal.history.$error.min || form.addmission_portal.geography.$error.min)">
                        Minimum marks are 0.
                    </p>

                    <p class="weak message" ng-show = "(form.addmission_portal.english.$dirty || form.addmission_portal.maths.$dirty || form.addmission_portal.hindi.$dirty || form.addmission_portal.history.$dirty || form.addmission_portal.geography.$dirty || form.addmission_portal.economic.$dirty) && (form.addmission_portal.english.$error.max || form.addmission_portal.maths.$error.max || form.addmission_portal.economics.$error.max || form.addmission_portal.hindi.$error.max || form.addmission_portal.history.$error.max || form.addmission_portal.geography.$error.max)">
                        Maximum marks are 100.
                    </p>
                </div>
					<div class="error message" ng-show = "fail">
						Data could not be inserted.
					</div>
					
					<div class="strong message text-center fw-bolder" ng-show = "success">
						Student data added succesfully.
					</div>
				</form>
			</div>
		</div>
<script src="../utilities/js/add_result.js"></script>

<script>
	function minHeight(){
		let viewportHeight = window.innerHeight;
		// console.log(viewportHeight);
		// console.log(typeof viewportHeight);
		document.body.style.minHeight = viewportHeight + "px";
	}
	window.addEventListener('load', minHeight);
	window.addEventListener('resize', minHeight);
</script>
</body>
</html>