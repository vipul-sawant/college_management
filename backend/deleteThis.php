<?php
require_once('../database/database.php');
$data = array();
$form_data = json_decode(file_get_contents('php://input'), true);
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($form_data['num'])) {
    $delete = "DELETE FROM students_info WHERE reg_no = '{$form_data['num']}'";
    $delete_query = mysqli_query($con, $delete);
    if ($delete_query) {
        $data['delete'] = 'yes';
    } else {
        $data['delete'] = '';
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($form_data['no'])) {
    $delete = "DELETE FROM marksheet WHERE reg_no = '{$form_data['no']}'";
    $delete_query = mysqli_query($con, $delete);
    if ($delete_query) {
        $data['delete'] = 'yes';
    } else {
        $data['delete'] = '';
    }
}
echo json_encode($data);
mysqli_close($con);
?>