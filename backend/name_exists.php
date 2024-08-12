<?php
require_once('../database/database.php');

if ($_SERVER['REQUEST_METHOD']==="POST"){
    
    $data = array();
	$form_data = json_decode(file_get_contents("php://input"), true);

	if (!empty($form_data)) {
        
		$name = $form_data["name"];
        
        $check_user = "SELECT * FROM admin_authentication WHERE admin_username = '$name'";
		$user_q = mysqli_query($con, $check_user);
		$user_rows = mysqli_num_rows($user_q);

		if ($user_rows === 0) {
            $data['userExist'] = "";
        } else {
            $data['userExist'] = "yes";
        }
    }
    
echo json_encode($data);
mysqli_close($con);
}
?> 