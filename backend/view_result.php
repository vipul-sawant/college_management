<?php
require_once('../database/database.php');
$data = array();
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['class_id'])) {
    // echo $_GET['class_id']."<br>";
    $classID = $_GET['class_id'];

    $getClass = "SELECT * FROM classes WHERE class_id='$classID'";
    $classQuery = mysqli_query($con, $getClass);
    $classRow = mysqli_fetch_assoc($classQuery);

    $getData = "SELECT * FROM students_info INNER JOIN marksheet ON students_info.reg_no = marksheet.reg_no WHERE students_info.class_info = '$classID'";
    $dataQuery = mysqli_query($con, $getData);
    $dataNum = mysqli_num_rows($dataQuery);
    if ($dataQuery && $dataNum > 0) {
        $data = array();
        while ($dataRow = mysqli_fetch_assoc($dataQuery)) {
            $data[] = $dataRow;
        }
        // echo('<pre>');
        //     print_r($data);
        // echo('</pre>');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js" integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="../angular-1.8.2/angular.min.js"></script> -->
<link rel="stylesheet" href="../utilities/css/basics.css">
<!-- <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css"> -->
	<title>Class Details</title>
    <style>
        th, td {
      padding: 10px; /* Adjust the value as needed */
      text-align: center; /* Optional: Align text within the th */
      border: 1px solid #ddd; /* Optional: Add a border for better visibility */
    }
    
    .edit, .delete, .back {
            /* background-color: green; */
            width: 75px;
            color:white;
            margin:5px;
            padding: 7px 12px;
            border:none;
            border-radius:5px;
            outline:none;
            font-weight:bold;
        }
        .edit{
            background-color: #009E60;
        }
        .delete{
            background-color: #DC143C;
        }
        .back{
            background-color: var(--yale-blue);
        }
        @media screen and (max-width: 768px) {    
            #thisDiv{
                flex-direction: column;
            }
        }
    </style>
<body>
    <div ng-app="studentCRUD" ng-controller="CRUDControl" class="d-flex" id="thisDiv">
        <div ng-include="'sidebar.php'" id="sidebar" class="sidebar d-flex flex-column"></div>
        <div class="flex-fill" id="content">
            <center><h1 class="h2 m-2 heading" style="font-size:3rem;"><?=$classRow['name'];?></h1></center>
            <div ng-show="read" style="overflow-x: scroll;" class="m-3">
                <table class="table table-responsive w-100 table-borderless rounded">
                    <tr style="background-color:#FECE23ff;color:beige;">
                        <th rowspan="2">Reg. No. </th>
                        <th colspan="6">Subjects</th>
                        <th rowspan="2">Total Marks(out of 600)</th>
                        <th rowspan="2">Percentage(%) </th>
                        <th rowspan="2"> Grade </th>
                        <th style="text-align: center;" rowspan="2" colspan="2">Actions</th>
                    </tr>
                    <tr style="background-color: var(--yale-blue); color: beige;">
                        <?php
                            if (!empty($data)) {
                                $result =  json_decode($data[0]['result'], true);
                                // print_r($result); 
                                foreach ($result as $key => $value) {
                                    if ($key != "total" && $key != "percent" && $key != "grade") {
                                        echo('<th>'.ucfirst($key).'</th>');
                                    }
                                }
                                echo('</tr>');
                                    foreach ($data as $k => $v) {
                                        echo('<tr class = "fw-bold">');
                                        echo('<td>'.$v['reg_no'].'</td>');
                                        $resultValues = json_decode($v['result'], true);
                                        foreach ($resultValues as $sub => $val) {
                                            echo('<td>'.$val.'</td>');
                                        }
                                        ?>
                                        <!-- <td> <button style="background-color: green;color:white;margin:5px; padding:5px; border:none; border-radius:5px; outline:none;" ng-click="selectThis(<?php echo $d['reg_no'];?>)"> Edit </button> </td>
                                        <td> <button style="background-color: red;color:white;margin:5px; padding:5px; border:none; border-radius:5px; outline:none;" ng-click="deleteThis(<?php echo $d['reg_no'];?>)"> Delete </button> </td> -->
                                        <td> <button class="edit" ng-click="selectThis(<?=$v['reg_no'];?>)"> Edit </button> </td>
                                        <td> <button class="delete" ng-click="deleteThis(<?=$v['reg_no'];?>)"> Delete </button> </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="11"><center><h1>No Data</h1></center></td>
                                    </tr>
                                    <?php
                                }
                        ?>
                    </tr>
                </table>
                <p ng-show="noDelete" class="message weak">Data Delete Failed</p>
                <p ng-show="delete" class="message strong">Data Deleted Successfully</p>
                <button type="button" class="back"> <a href="result_portal.php" style="text-decoration:none; color:beige;"> Back </a> </button>
            </div>
        <div ng-show="edit" class="d-flex justify-content-center align-items-center flex-column">
           <form name="form.addmission_portal" method="post" ng-submit = "form.addmission_portal.$valid && editMarks()" class="admin_form" novalidate>
                <!-- <div class="row">
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
                            Please Enter Maths Marks.
                        </p>

                        <p ng-show = " form.addmission_portal.maths.$dirty && form.addmission_portal.maths.$error.min">
                            Minimum 0.
                        </p>

                        <p ng-show = " form.addmission_portal.maths.$dirty && form.addmission_portal.maths.$error.max">
                            Maximum 100.
                        </p>
                    </div>
                </div> -->
                <!-- <div ng-include="'student_details_form.html'"></div> -->
                <h1 class="h3 heading fw-bold">Edit Marks</h1>
                <div class="m-2">
                    <label for="reg_no" class="heading fw-bold">
                    Reg.No. : 
                    </label>
                </div>

                <div class="detail_box d-flex m-2">
                    <!-- <label for="reg_no"> 
                        <i class="fa-regular far fa-id-card icon"></i>
                    </label> -->
                    <p ng-bind="reg_no" class="detail_input m-0"></p>
                </div>
                
                <div class="m-2">
                    <label for="english" class="heading fw-bold">
                        English : 
                    </label>
                </div>

                <div class="detail_box d-flex m-2" ng-class="{'input_error':form.addmission_portal.english.$dirty && (form.addmission_portal.english.$error.min || form.addmission_portal.english.$error.max || form.addmission_portal.english.$error.required)}">
                    <!-- <label for="english">  -->
                        <!-- <i class="fa-regular far fa-user icon"></i> -->
                        <!-- <i class="fa-solid fa-book"></i> -->
                    <!-- </label> -->
                    <!-- <input type="text" id="fName"  name="fName" ng-model = "student.fName" placeholder=" Enter First Name Here " validate-name required> -->
                    <input type="number" class="detail_input" id="english" name="english"  ng-model = "student.english" ng-min="0" ng-max="100"  required />
                </div>
                
                <div class="m-2">
                    <label for="maths" class="heading fw-bold">
                        Maths : 
                    </label>
                </div>

                <div class="detail_box d-flex m-2" ng-class="{'input_error':form.addmission_portal.maths.$dirty && (form.addmission_portal.maths.$error.min || form.addmission_portal.maths.$error.max || form.addmission_portal.maths.$error.required)}">
                    <!-- <label for="maths">  -->
                        <!-- <i class="fa-regular far fa-user icon"></i> -->
                        <!-- Maths -->
                    <!-- </label> -->
                    <!-- <input type="text" id="fName"  name="fName" ng-model = "student.fName" placeholder=" Enter First Name Here " validate-name required> -->
                    <input type="number" class="detail_input" id="maths" name="maths"  ng-model = "student.maths" ng-min="0" ng-max="100"  required />
                </div>
                <?php
                // echo($classID);
                    if ($classID == '11' ||$classID == '12') {?>
                        <div ng-include="'science_form.html'"></div>
                    <?php
                    } else if ($classID == '13' ||$classID == '14') {?>
                        <div ng-include="'commerce_form.html'"></div>
                    <?php
                    } else if ($classID == '15' ||$classID == '16') {?>
                        <div ng-include="'arts_form.html'"></div>
                        <?php
                    }
                ?>
                <!-- <div class="row">
                    <div class="col-lg-2">
                        <label for="total">Total (out of 600) :</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="number" id="total" name="total" value="{{total()}}" disabled required />
                    </div>
                </div> -->

                
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

                <div class="d-flex justify-content-between">
                    <button class="edit">Edit</button>
                    <button type="button" class="back" ng-click="reset()">Reset</button>
                </div>
            </form>
                <div ng-if="<?php echo $classID;?> === 11 || <?php echo $classID;?> === 12" class="m-3">
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

                <div ng-if="<?php echo $classID;?> === 13 || <?php echo $classID;?> === 14" class="m-3">
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

                <div ng-if="<?php echo $classID;?> === 15 || <?php echo $classID;?> === 16" class="m-3">
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
                <!-- <p>form valid {{form.addmission_portal.$valid}}</p> -->
            </div>
            <p ng-show="fail" class="message weak">Data Edit Failed</p>
            <p ng-show="success" class="message strong">Data Edited Successfully</p>
        </div>
    </div>
<script type="text/javascript" src="../utilities/js/crudMarks.js"></script>

<script>
    const content = document.getElementById('content');
    const sidebar = document.getElementById('sidebar');
    const body = document.body;
    console.log(sidebar);
    console.log(body);

    function resizeFeature() {
        const viewportWidth = body.clientWidth;
        // console.log(viewportWidth);
        
        // const sidebarWidth = sidebar.offsetWidth;
        
        // sidebar.style.width = "220px";
        // const style = window.getComputedStyle(sidebar);
        // console.log(style);
        // const sidebarWidth = style.width;
        
        // const sidebarWidth = sidebar.clientHeight;
        // console.log(sidebarWidth);
        
        if (viewportWidth > 768.00) {
            const contentWidth = viewportWidth - 220;
            console.log(contentWidth);

            content.style.width = contentWidth + "px";   
        } else {
            content.style.width = viewportWidth + "px";
        }
    }
    window.addEventListener('load', resizeFeature);
    window.addEventListener('resize', resizeFeature);
</script>

</body>
</html> 