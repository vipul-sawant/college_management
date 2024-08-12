<?php

require_once('../database/database.php');

if ($_SERVER['REQUEST_METHOD']==="POST") {

	$data = array();
	$form_data = json_decode(file_get_contents("php://input"), true);

	if (!empty($form_data)) {

		$data['error'] = '';

		$name = $form_data["name"];
		$hash  = password_hash($form_data["cPass"], PASSWORD_DEFAULT);

		$add = "INSERT INTO admin_authentication(admin_username, pass_word) values('$name','$hash')";
		$add_q = mysqli_query($con, $add);

		if ($add_q) {
			$data['add'] = "yes";
		} else {
			$data['add'] = "";
		}

		if ( mysqli_error($con) || mysqli_errno($con) ) {
			echo '<p> Error Message : '.mysqli_error($con).'</p>';
			echo '<p> Error No : '.mysqli_errno($con).'</p>';
		}
	} else {
		$data['error'] = 'yes';
	}
	echo json_encode($data);
	mysqli_close($con);
}
?>