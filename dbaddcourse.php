<?php
include ('connection.php');

$query = "SELECT * from checklist";
$result = mysqli_query($con, $query);
//lol what are these for?

//details in checklist table
$coursenum = "";
$term = "";
$stat = "";
$grade = "";
$yn = "";
//$gwa; //jen

$error;

//$db = mysqli_connect($host, $user, $pass, $db);
  //mysqli_select_db($con, 'checklistfrincy');
  //mysqli_query($con, "INSERT into checklist VALUES ('$coursenum', '$term', '$stat')");
if (isset($_POST['addcbtn'])) {
  // receive all input values from the form
  $coursenum = mysqli_real_escape_string($con, $_POST['courseno']);
  $term = mysqli_real_escape_string($con, $_POST['termtaken']);
  $stat = mysqli_real_escape_string($con, $_POST['status']);
//jen
  $grade = mysqli_real_escape_string($con, $_POST['grade']);
  $yn = mysqli_real_escape_string($con, $_POST['yon']);
//end of jen

  // first check the database to make sure 
  // a course does not already exist with the same course num and/or course code
  $course_check_query = "SELECT * FROM course WHERE COURSE_NUM='$coursenum' LIMIT 1";
  $result = mysqli_query($con, $course_check_query);
  $course = mysqli_fetch_assoc($result);
  
  if (! $course) { // if course does not exist in the course table database
   // if ($course['COURSE_NUM'] == $coursenum) {
      echo '<script type="text/javascript">';
      echo 'alert("That course does not exist in the database.
      Please register course before adding to checklist.")';
      echo '</script>';
      //javascript isn't working for some reason but the code works
      header('Location: addcourse.php');
      $error = true; //true; error exists
  }else {
      $error = false; //false; error does not exist
  }
  
  // Finally, add class to db if there are no errors in the form
  if ($error == false) {
//jen    
    $addchecklist_query = "INSERT INTO checklist (COURSE_NUM, TERM_TAKEN, STATUS, GRADE, TO_COMPUTE) 
          VALUES('$coursenum', '$term', '$stat', '$grade', '$yn')";
//end of jen          
    mysqli_query($con, $addchecklist_query);
    echo '<script type="text/javascript">';
    echo 'alert("Course successfully added to checklist!")';
    echo '</script>';
    //javascript isn't working for some reason but the code works
    if (mysqli_num_rows($result) == 1) {
      header('Location: home.php');
    }
  }
}
?>

