<?php
require_once('../database/database.php');
$data = array();
if ($_SERVER['REQUEST_METHOD']==="GET") {
    $classID = intval($_GET['class_id']);
    // echo $_GET['class_id'];

    $select = "SELECT students_info.reg_no FROM students_info LEFT JOIN marksheet ON students_info.reg_no = marksheet.reg_no WHERE students_info.class_info = '$classID' AND marksheet.reg_no IS NULL";
    $select_query = mysqli_query($con, $select);
    $all_reg_no = array();
    while ($select_row = mysqli_fetch_assoc($select_query)) {
        $all_reg_no[] = $select_row['reg_no'];
    }
    $data['reg_nos_s'] = $all_reg_no;
}
echo json_encode($data['reg_nos_s']);
mysqli_close($con);
?>