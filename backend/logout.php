<?php
session_start();
if (isset($_SESSION['uname'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page
    header("Location: admin_login.html");
    exit();
}
?>