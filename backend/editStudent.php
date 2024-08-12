<?php
require_once('../database/database.php');
$form_data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($form_data)) {
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
            $edit = "UPDATE students_info SET first_name = '$fName', middle_name = '$mName', last_name = '$lName', birth_date = '$dob', phone = '$phone', e_mail = '$email', home_address = '$address' WHERE reg_no = '{$form_data['reg_no']}'";
			$edit_query = mysqli_query($con, $edit);

			if ($edit_query) {

				$data['edit'] = "yes";
			} else {
				
				$data['edit'] = "";
			}
}
echo json_encode($data);
mysqli_close($con);
?>