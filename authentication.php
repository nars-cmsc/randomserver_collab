<?php

include('connection.php');
$upemail = $_POST['upemail'];
$password = $_POST['password'];

//to prevent from mysqli injection
$upemail = stripcslashes($upemail);
$password = stripcslashes($password);
$upemail = mysqli_real_escape_string($con, $upemail);
$password = mysqli_real_escape_string($con, $password);

$sql = "select *from login where up_email = '$upemail' and password = '$password'";
$result = mysqli_query($con, $sql);
/*
to check error
if ($result != 1) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
*/
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1){
	//echo "<h3><center> Login successful! </center></h3>";
	header('Location: home.php'); 
    exit;
}
else{
	//echo "<h3><center> Login failed. Invalid username and/or password. </center></h3>";
	header('Location: index.php'); 
    exit;
}

?>
