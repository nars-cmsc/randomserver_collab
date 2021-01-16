<?php
//all is jen
if(isset($_SESSION['upemail'])){
	$result = mysqli_query($con, "SELECT TOKEN FROM usersession WHERE UP_EMAIL='".$_SESSION['upemail']."'");
	
	//if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		//$token = $row['TOKEN'];

		if($row['TOKEN'] != $_SESSION['token']){
			session_destroy();
			header('Location: logout.php');
			echo '<script type="text/javascript">';
      		echo 'alert("Previous session destroyed. Automatic logout. You can only login once at a time.")';
      		echo '</script>';
		}
//	}
}



?>