<?php

session_start();

if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['uname'])) {
    require_once('add_student.html');
} else {
	header('location:admin_login.html');
}

?>