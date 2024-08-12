<?php
session_start();
if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['uname'])) {
    // echo "<center><h1>Hello</h1></center>";
    require_once('new_dashboard.html');
} else {
    header('location:admin_login.html');
}
?>