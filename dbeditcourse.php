<?php
//jen
if(count($_POST) > 0){
    mysqli_query($con, "UPDATE checklist set TERM_TAKEN='".$_POST['termtaken']."', STATUS='".$_POST['status']."', GRADE='".$_POST['grade']."', TO_COMPUTE='".$_POST['yon']."' WHERE COURSE_NUM = '".$_POST['coursenumber']."'");
    $message = "Record modified successfully!";
    header('Location: home.php');
}
$get_item = "SELECT * FROM checklist WHERE COURSE_NUM ='".$_GET['coursenumber']."'; ";
$result = mysqli_query($con, $get_item);
$row = mysqli_fetch_array($result);

?>