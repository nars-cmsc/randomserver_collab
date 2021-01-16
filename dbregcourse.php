<?php

include ('connection.php');

$query = "SELECT * from course";
$result = mysqli_query($con, $query);

//details in course table
$code = "";
$coursenum = "";
$title = "";
$units = "";

$error;

//$db = mysqli_connect($host, $user, $pass, $db);
  //mysqli_select_db($con, 'checklistfrincy');
  //mysqli_query($con, "INSERT into checklist VALUES ('$coursenum', '$term', '$stat')");
if (isset($_POST['regcbtn'])) {
  // receive all input values from the form
  $code = mysqli_real_escape_string($con, $_POST['coursecode']);
  $coursenum = mysqli_real_escape_string($con, $_POST['courseno']);
  $title = mysqli_real_escape_string($con, $_POST['coursetitle']);
  $units = mysqli_real_escape_string($con, $_POST['courseunits']);
//$units = mysqli_real_escape_string($con, (float)$_POST['courseunits']);

  // first check the database to make sure 
  // a course does not already exist with the same course num and/or course code
  $course_check_query = "SELECT * FROM course WHERE COURSE_NUM='$coursenum' LIMIT 1";
  $result = mysqli_query($con, $course_check_query);
  $course = mysqli_fetch_assoc($result);
  
  if($course){ //if course exists in the course table database
    if ($course['COURSE_NUM'] == $coursenum) {
      echo '<script type="text/javascript">';
      echo 'alert("A course already exists with that course code! 
      Please check the Course List to add the course to your checklist if you have taken/are currently taking the course.")';
      echo '</script>';
      $error = true;
      header('Location: regcourse.php');
    }
  }else {
    $error = false;
  }

  // Finally, add class to db if there are no errors in the form
  if ($error == false) {
    $regcourse_query = "INSERT INTO course (COURSE_CODE, COURSE_NUM, COURSE_TITLE, COURSE_UNITS) 
          VALUES('$code', '$coursenum', '$title', '$units')";
    mysqli_query($con, $regcourse_query); 

    //echo '<script type="text/javascript">';
    //echo 'alert("Course successfully registered in database!")';
    //echo 'window.location.href="regcourse.php"';
    //echo '</script>';
    
    
    //if (mysqli_num_rows($result) == 1) {
      header('Location: home.php');
    //}
  }
}
?>