<?php
require_once 'database/database.php';
$form_data = json_decode(file_get_contents('php://input'), true);
$data = array();
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($form_data['reg_no'])) {
    $regNo = $form_data['reg_no'];
    
    $student1 = "SELECT * FROM students_info WHERE reg_no = '{$regNo}'";
    $student1_query = mysqli_query($con, $student1);
    $student1_num = mysqli_num_rows($student1_query);
    if ($student1_num > 0) {
        
        $info = "SELECT * FROM students_info INNER JOIN marksheet ON students_info.reg_no = marksheet.reg_no WHERE students_info.reg_no='{$form_data['reg_no']}'";
        $info_query = mysqli_query($con, $info);
        $info_num = mysqli_num_rows($info_query);
        if ($info_num > 0) {
                $info_row = mysqli_fetch_assoc($info_query);
                echo json_encode($info_row);
        } else {
            $data['declare'] = "no";
            echo json_encode($data);
        }
    } else {
        $data['student'] = "no";
        echo json_encode($data);
    }

}
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($form_data['class_id'])) {
    $class = "SELECT name FROM classes WHERE class_id='{$form_data['class_id']}'";
    $class_query = mysqli_query($con, $class);
    $class_num = mysqli_num_rows($class_query);
    if ($class_num > 0) {
        $class_row = mysqli_fetch_assoc($class_query);
        $data['class'] = $class_row['name'];
        echo json_encode($data);
    }
}
// echo json_encode($data);
mysqli_close($con);
?>