<?php

session_start();
//jen

$host = "localhost";
$user = "root";
$pass = '';
$db = "cs127group3final";


$con = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
	die("Failed to connect with MySQL: ". mysqli_connect_error());
}

?>

