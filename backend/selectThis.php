<?php
require_once('../database/database.php');
$data = array();
$form_data = json_decode(file_get_contents('php://input'), true);
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($form_data['num'])) {
    $select = "SELECT * FROM students_info WHERE reg_no = '{$form_data['num']}'";
    $select_query = mysqli_query($con, $select);
    $select_num = mysqli_num_rows($select_query);
    if ($select_num > 0) {
        $select_row = mysqli_fetch_assoc($select_query);
        $data['first_name'] = $select_row['first_name'];
        $data['middle_name'] = $select_row['middle_name'];
        $data['last_name'] = $select_row['last_name'];
        $data['phone'] = $select_row['phone'];
        $data['email']= $select_row['e_mail'];
        $data['address'] = $select_row['home_address'];
        $data['birth_date'] = $select_row['birth_date'];
        $data['reg_no'] = $select_row['reg_no'];
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($form_data['no'])) {
    $select = "SELECT * FROM marksheet WHERE reg_no = '{$form_data['no']}'";
    $select_query = mysqli_query($con, $select);
    $select_num = mysqli_num_rows($select_query);
    if ($select_num > 0) {
        $select_row = mysqli_fetch_assoc($select_query);
        $data['reg_no'] = $select_row['reg_no'];
        $result = json_decode($select_row['result'], true);
        foreach ($result as $key => $value) {
            $data[$key] = $value;
        }
        // $data['reg_no'] = $select_row['reg_no'];
    }
}
echo json_encode($data);
mysqli_close($con);
?>