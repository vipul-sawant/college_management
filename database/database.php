<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "college";

$con = mysqli_connect($server,$user,$password,$database);

if (mysqli_connect_errno()) {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
