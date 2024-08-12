<?php
require_once('../database/database.php');
$data = array();

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $info = "SELECT * FROM students_info";
    $info_query = mysqli_query($con, $info);
    $info_num = mysqli_num_rows($info_query);
    $data['whole'] = $info_num;

    $getClasses = "SELECT * FROM classes ORDER BY class_id";
		$class_query = mysqli_query($con, $getClasses);
		$class_num = mysqli_num_rows($class_query);
		if ($class_num > 0) {
			$storeCLasses = array();
			while ($class_rows = mysqli_fetch_assoc($class_query)) {
				$storeCLasses[] = $class_rows;
			}
			$data['classes'] = $storeCLasses;
		}
}
echo json_encode($data);
mysqli_close($con);
?>