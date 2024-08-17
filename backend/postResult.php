<?php
$form_data = json_decode(file_get_contents('php://input'),true);
$data = array();
if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($form_data)) {
    require_once('../database/database.php');
    $reg_no = $form_data['reg_no'];
    if (array_key_exists('reg_no', $form_data)) {
        unset($form_data['reg_no']);
    }
    // print_r($form_data)
    $score_data = json_encode($form_data);
    $add = "INSERT INTO marksheet (reg_no, result) VALUES ('$reg_no', '$score_data')";
    $add_query = mysqli_query($con, $add);
    if ($add_query) {
        $data['add'] = "yes";
    } else {
        $data['add'] = "";
    }
}
echo json_encode($data);
mysqli_close($con);
?>