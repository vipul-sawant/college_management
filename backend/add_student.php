<?php
	require_once("../database/database.php");
	$data = array();
	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		$getClasses = "SELECT * FROM classes Order BY name";
		$class_query = mysqli_query($con, $getClasses);
		$class_num = mysqli_num_rows($class_query);
		if ($class_num > 0) {
			$storeCLasses = array();
			while ($class_rows = mysqli_fetch_assoc($class_query)) {
				$storeCLasses[] = $class_rows;
			}
			$data['class'] = $storeCLasses;
			// print_r($data['row']);
		}
	}

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
	   
   
	   $form_data = json_decode(file_get_contents("php://input"), true);

		// if (isset($form_data['mobile'])) {
		// 	$checkMobile = "SELECT * FROM students_info WHERE phone = '{$form_data['mobile']}'";
		// 	$mobileQuery = mysqli_query($con, $checkMobile);

		// 	if ($mobileQuery) {
		// 		$mobileRow = mysqli_num_rows($mobileQuery);
		// 		if ($mobileRow > 0) {
		// 			$data['mobile'] = "yes";
		// 		} else {
		// 			$data['mobile'] = "";
		// 		}
		// 	}
		// } else if (isset($form_data['e_mail'])) {
		// 	$checkMail = "SELECT * FROM students_info WHERE e_mail = '{$form_data['e_mail']}'";
		// 	$mailQuery = mysqli_query($con, $checkMail);

		// 	if ($mailQuery) {
		// 		$mailRow = mysqli_num_rows($mailQuery);
		// 		if ($mailRow > 0) {
		// 			$data['e_mail'] = "yes";
		// 		} else {
		// 			$data['e_mail'] = "";
		// 		}
		// 	}
		// } else if (isset($form_data['fName'])) {
			$fName = $form_data['fName'];
			if (isset($form_data['mName'])) {
				$mName = $form_data['mName'];
			} else {
				$mName = '';
			}
			$lName = $form_data['lName'];
			$dob = $form_data['dob'];
			$phone = $form_data['phone'];
			$email = $form_data['email'];
			$address = $form_data['address'];
			$classes = $form_data['classes'];
			$insert = "INSERT INTO students_info(first_name, middle_name, last_name, birth_date, phone, e_mail, home_address, class_info) VALUES('$fName', '$mName', '$lName', '$dob', '$phone', '$email', '$address', '$classes')";
			$insert_query = mysqli_query($con, $insert);

			if ($insert_query) {

				$data['insert'] = "yes";
			} else {
				
				$data['insert'] = "";
			}
		// }

	}
	echo json_encode($data);
	mysqli_close($con);
?>