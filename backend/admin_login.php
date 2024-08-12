<?php

require_once('../database/database.php');
if ($_SERVER['REQUEST_METHOD']==="POST"/* && isset($_POST['name'])  && $_POST['name'] !== ""  && isset($_POST['cPass'])  && $_POST['cPass'] !== "" */) {
	$form_data = json_decode(file_get_contents('php://input'), true);

	$data = array();
	// $error = array();

	$uname = mysqli_real_escape_string($con,$form_data['uname']);
	$pass = mysqli_real_escape_string($con,$form_data['pass']);

	$user = "SELECT * FROM admin_authentication where admin_username = '$uname'";

	$user_q = mysqli_query($con,$user);
	$row = mysqli_fetch_array($user_q,MYSQLI_ASSOC);
	$count = mysqli_num_rows($user_q);

	if ($count > 0) {
			$data["uname"] = "";
			if (password_verify($pass, $row["pass_word"])) {
					session_start();
					$data["pass"] = "";
					$_SESSION["uname"] = $row["admin_username"];
			} else {
				$data["pass"] = "yes";
			}
	} else {
		$data['uname'] = "yes";
		// $error["uname"] = "yes";
	}
	// $data["error"] = $error;
	echo json_encode($data);
	mysqli_close($con);
}

 ?>