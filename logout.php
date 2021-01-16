<?php
//note: logout is working normally
if(!isset($_SESSION['upemail'])){
	$logupmail = mysqli_real_escape_string($con, $_SESSION['upemail']);
    mysqli_query($con, "DELETE FROM usersession where UP_EMAIL='".$_SESSION['upemail']."'");
    session_destroy();
    header('Location: index.php');
}else{
    header('Location: index.php');
}



?>