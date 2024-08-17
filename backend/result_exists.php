<?php
require_once '../database/database.php';

$data = array();
$form_data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD']==="POST" && !empty($form_data)){
		$reg_no = $form_data["reg_no"];
        
        $check_result = "SELECT * FROM marksheet WHERE reg_no = '$reg_no'";
		$result_query = mysqli_query($con, $check_result);
		$result_rows = mysqli_num_rows($result_query);

		if ($result_rows === 0) {
            $data['resultExist'] = "";
        } else {
            $data['resultExist'] = "yes";
        }
    }
    
echo json_encode($data);
mysqli_close($con);
?> 