<?php
	require_once("../database/database.php");
	$data = array();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
	   
   
        $form_data = json_decode(file_get_contents("php://input"), true);
 
         if (isset($form_data['mobile'])) {
            // if (!isset($form_data['reg_no'])) {
                if (isset($form_data['reg_no'])) {
                    $checkMobile = "SELECT * FROM students_info WHERE phone = '{$form_data['mobile']}' AND reg_no != '{$form_data['reg_no']}'";
                } else {
                    $checkMobile = "SELECT * FROM students_info WHERE phone = '{$form_data['mobile']}'";
                }
                
                $mobileQuery = mysqli_query($con, $checkMobile);

                if ($mobileQuery) {
                    $mobileRow = mysqli_num_rows($mobileQuery);
                    if ($mobileRow > 0) {
                        $data['mobile'] = "yes";
                    } else {
                        $data['mobile'] = "";
                    }
                // }
            }
         } else if (isset($form_data['e_mail'])) {
            if (isset($form_data['reg_no'])) {
                $checkMail = "SELECT * FROM students_info WHERE e_mail = '{$form_data['e_mail']}' AND reg_no != '{$form_data['reg_no']}'";
            } else {
                $checkMail = "SELECT * FROM students_info WHERE e_mail = '{$form_data['e_mail']}'";
            }
            //  $checkMail = "SELECT * FROM students_info WHERE e_mail = '{$form_data['e_mail']}'";
             $mailQuery = mysqli_query($con, $checkMail);
 
             if ($mailQuery) {
                 $mailRow = mysqli_num_rows($mailQuery);
                 if ($mailRow > 0) {
                     $data['e_mail'] = "yes";
                 } else {
                     $data['e_mail'] = "";
                 }
             }
         }
}
echo json_encode($data);
mysqli_close($con);