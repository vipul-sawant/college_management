<?php
session_start();
require_once('../database/database.php');
$data = array();
// echo $_GET['data'];
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['class_id'])) {
    // echo $_GET['class_id'];
    $class = "SELECT * FROM students_info LEFT JOIN classes ON students_info.class_info = classes.class_id WHERE students_info.class_info = '{$_GET['class_id']}'";
    $class_query = mysqli_query($con, $class);
    $class_num = mysqli_num_rows($class_query);
    if ($class_num > 0) {
        while($class_row = mysqli_fetch_assoc($class_query)){
            $data[] = $class_row;
        }
    }
}
// echo('<pre>');
// print_r($data);
// echo('</pre>');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js" integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../node_modules/angular/angular.min.js"></script>
<!-- <link rel="stylesheet" href="css/new_dashboard.css"> -->
<link rel="stylesheet" href="../utilities/css/basics.css">
	<title>Class Details</title>
    <style>
        .data{
            font-weight: bold;
            font-size: 15px;
        }
        #container{
            background:none;
        }
         .content{
			width: 100%;
			display: block;
            /* overflow-x: scroll; */
		}
        /* #admissionForm{
			width: var(--forms);
			display: flex;
			justify-content: center;
			flex-direction: column;	
		} */
		#admissionForm{
			width: var(--forms);
			display: flex;
			justify-content: center;
			flex-direction: column;	
			margin: 0px auto;
		}
		.detail_box{
			display: flex;
			margin: 12px;
			border: 0.5px solid #999;
			padding: 10px;
			border-radius: 10px;
			background-color: beige;
		}
		.detail_input{
			color: inherit;
			font-weight: 550;
			padding-left: 10px;
			border: none;
			outline: none;
			color: inherit;
			background-color: inherit;
		}
		.detail_input::placeholder{
			color: inherit;
			font-weight: 450;
		}
		#btn{
			background-color: #013A79ff;
			padding: 12px;
			margin: 12px auto;
			color: beige;
			border: none;
			outline: none;
			border-radius: 12px;
			width: 50%;
		}
        .content{
            padding: 0px;
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
    </style>
<body>
    <div ng-app="studentCRUD" ng-controller="CRUDControl" class="d-flex" id="container">
        <div class="sidebar d-flex flex-column" id="sidebar" ng-include="'sidebar.php'">
        </div>
        <div class="content" id="content" style="padding: 12px;">
        <center><h1 class="h2 heading"><?=$_GET['className'];?></h1></center>
            <div ng-show="read" style="overflow-x: scroll;">
                <table class="table table-responsive table-hover w-100 table-borderless rounded" style="border-radius:12px; overflow-x:scroll;">
                    <tr style="background-color:#FECE23ff;color:beige;">
                        <th>Reg. No. </th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Birth Date</th>
                        <th>Phone</th>
                        <th>E-Mail</th>
                        <th>Address</th>
                        <th style="text-align: center;" colspan="2">Action</th>
                    </tr>
                        <?php
                            foreach($data as $key => $d){
                                echo("<tr class='data'><td>".$d['reg_no']."</td>");
                                echo("<td>".$d['first_name']."</td>");
                                echo("<td>".$d['middle_name']."</td>");
                                echo("<td>".$d['last_name']."</td>");
                                echo("<td>".$d['birth_date']."</td>");
                                echo("<td>".$d['phone']."</td>");
                                echo("<td>".$d['e_mail']."</td>");
                                echo("<td>".$d['home_address']."</td>");?>
                                <td> <button class="edit" ng-click="selectThis(<?php echo $d['reg_no'];?>)"> Edit </button> </td>
                                <td> <button class="delete" ng-click="deleteThis(<?php echo $d['reg_no'];?>)"> Delete </button> </td>
                        <?php
                            }
                        ?>
                    </tr>
                </table>
                <p ng-show="noDelete" class="fw-bolder message weak text-center">Data Delete Failed</p>
                <p ng-show="delete" class="fw-bolder message strong text-center">Data Deleted Successfully</p>
                <button type="button" class="back"> <a href="new_dashboard.php" style="text-decoration:none; color:beige"> Back </a> </button>
                </div>
                <div ng-show="edit" class="d-flex flex-column justify-content-center align-items-center">
                <form name="form.admission_portal" method="post" ng-submit = "form.admission_portal.$valid && editUser()" novalidate style="width: 100%; max-width: 320px;">
                    <h1 class="h2 text-center font-weight-bold" style="font-weight:bold;">Student Edit</h1>
                    <p> Reg. No. :- <span ng-bind="student.reg_no"></span> </p>
                    <div ng-include="'student_details_form.html'" class="content"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="edit" class="poppins-black"> Edit </button>
                        <button type="button" class="back" class="poppins-black" ng-click="reset()"> Reset </button>
                    </div>    
                    
                </form>
                    <!-- <p>form valid {{form.admission_portal.$valid}}</p>
                    <p>First Name :  {{form.admission_portal.fName.$error}}</p>
                    <p>Middle Name :  {{form.admission_portal.mName.$error}}</p>
                    <p>Last Name :  {{form.admission_portal.lName.$error}}</p>
                    <p> Phone :  {{form.admission_portal.phone.$error}}</p>
                    <p> E-Mail :  {{form.admission_portal.email.$error}}</p> -->
                    <p ng-show="fail" class="fw-bolder message weak text-center">Data Edit Failed</p>
                    <p ng-show="success" class="fw-bolder message strong text-center">Data Edited Successfully</p>
                    <!-- <div class="row">
                        <div class="col-sm-12">
                            <button type="button" ng-click="reset()">Reset</button>
                        </div>
                    </div> -->
                </div>
        </div>
    
    </div>
<script type="text/javascript" src="../utilities/js/crudStudent.js"></script>

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