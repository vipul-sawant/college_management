<?php
require_once('../database/database.php');
$form_data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($form_data)) {
    $reg_no = $form_data['reg_no'];
    if (array_key_exists('reg_no', $form_data)) {
        unset($form_data['reg_no']);
    }
    $marksData = json_encode($form_data);
            $edit = "UPDATE marksheet SET result = '$marksData' WHERE reg_no = '$reg_no'";
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