<?php
include ('connection.php');
include ('tokencheck.php');
//include ('logout.php'); //note:should not include logout.php
//session_start(); //removal jen
//possible problem that session_start should start here?
//login problem...
//values not reflected in db


/*
JEN UPDATES:
tokencheck.php
logout.php
addcourse.php
editcourse.php
home.php
connection.php
dbregister.php

NOTES: 
(check) frincy's code successfully added and functioning as it should
(check) luz's code about the del function is working normally in viewcourse.php and home.php (only files where she updated)successfully added and functioning as it should
(check) levy's og code has been modified and successfully works
(check) effin code finally works FINALLY AKJSLKDJFSLIJFSKDJ
*/

  if (!isset($_SESSION['upemail'])) {
  	$_SESSION['msg'] = "You must log in first!";
  	header('Location: index.php');
  }

  /* jen removal note: replaced by logout.php
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['upemail']);
  	header('Location: index.php');
  }
 */
  //Note: home.php = index.php (in website reference)

?>

<html>
<head>
	<title>PHP Dashboard</title>
  <link rel="stylesheet" href="..\bootstrap-3.4.1-dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="..\bootstrap-3.4.1-dist\js\bootstrap.min.js">
	<link rel = "stylesheet" type = "text/css" href = "main_css.css">
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home</a></li>
        <li><a href="regcourse.php">Register Additional Class</a></li>
        <li><a href="addcourse.php">Add Class to Checklist</a></li>
        <li><a href="viewcourse.php">View List of Courses</a></li>
        <li><a href="ongoingcourse.php">View List of On-Going Courses</a></li>
        <li><a href="passedcourse.php">View List of Passed Courses</a></li>
        <li><a href="failedcourse.php">View List of Failed Coursess</a></li>
      </ul>

      <ul class="nav navbar-nav mr-auto">
        <li><a href="logout.php">Log-out</a></li>
      </ul>
    </div>
  </nav>
  
	
	<div class="content">
  		<!-- notification message -->
  		<?php if (isset($_SESSION['success'])) : ?>
      		<div class="error success" >
      			<h3>
          			<?php 
          				echo $_SESSION['success']; 
          				unset($_SESSION['success']);
          			?>
      			</h3>
      		</div>
  					<?php endif ?>

    	<!-- logged in user information -->
    	<?php  if (isset($_SESSION['upemail'])) : ?>
    		<!-- 
    			<p>Welcome <strong><?php //echo $_SESSION['upemail']; ?></strong></p>
    		-->
        <!-- this kind of logout is different from logout.php since this kind is manually done... the other is automatic checking in each page-->
        <!-- home.php?logout='1' -->
    	<?php endif ?>
	</div>

  <?php
    //jen
    //this is for an updated computation of gwa 
    //NEEDS TO BE FIXED PROBLEM WITH GETTING COURSE NUMBER
    // /*
    $from_checklist = mysqli_query($con, "SELECT COURSE_NUM, GRADE FROM checklist WHERE TO_COMPUTE='YES'");

    //$getinfo = mysqli_fetch_assoc($from_checklist);

    $denomrows = mysqli_num_rows($from_checklist);
    //total number of courses
    //  echo $denominator; //this is working
    $numerator = 0;
    $denominator = 0;

    if($denomrows > 0){
      
      while($chcell=mysqli_fetch_assoc($from_checklist)){
      //$cnum = "";
      $cnum = $chcell['COURSE_NUM'];
      //echo $cnum; //these are both working okay
      //echo $chcell['COURSE_NUM'];
      //get course name

      $from_course = mysqli_query($con, "SELECT COURSE_UNITS FROM course WHERE COURSE_NUM='$cnum'");
      $cocell = mysqli_fetch_assoc($from_course); //trying to fix, was info
        
        if(mysqli_num_rows($from_course) === 1){
        
          $cgrade = $chcell['GRADE'];
          //echo $cgrade; this is working okay
          //get grade value

          //$cocell = mysqli_fetch_assoc($from_course); //append with info
          $cocounits = $cocell['COURSE_UNITS']; //this is the prob
          //echo $cocounits;//working
          //echo $cocell['COURSE_UNITS']; //working
          //get course units of course name  
          //echo $numerator;
          //echo $cgrade; 
          //echo $cocounits;
          //individual echos work
          //echo ($cgrade*$cocounits); // this works
          //echo $denominator;//this works


          $numerator = $numerator + ($cgrade * $cocounits);
          $denominator = $denominator + $cocounits;
        }
      }

      $gwa = $numerator / $denominator;

      $gwaupdate = mysqli_query($con, "UPDATE student SET GWA='$gwa'WHERE UP_EMAIL='".$_SESSION['upemail']."'");
    }
    // */
    //end of jen

    $getuserdata = "SELECT * FROM student WHERE UP_EMAIL = '".$_SESSION['upemail']."'";
    //mysql_select_db('cs124jendb');
    $retval = mysqli_query($con, $getuserdata);
    
    if(! $retval ) {
        die('Could not get user details: ' . mysqli_error($con));
    }
    
    while($row = mysqli_fetch_assoc($retval)) {
        echo "Welcome {$row['FIRST_NAME']}!<br> ".
          "NAME: {$row['FIRST_NAME']} {$row['MIDDLE_NAME']} {$row['LAST_NAME']} <br> ".
          "SAIS ID: {$row['SAIS_ID']} <br> ".
          "Student ID: {$row['STUDENT_ID']} <br> ".
          "General Weighted Average: {$row['GWA']} <br> ".
          "UP Email: {$row['UP_EMAIL']} <br> ".
          "--------------------------------<br>";
    }
    
    mysqli_free_result($retval);
      //  echo "\nFetched data successfully!\n";
  ?>
  
  <!-- THE TABLE CODE SLIGHTLY VARIES FROM FRINCYS TO LUZS BUT ITS NOT IMPORTANT. THE ONLY DIFFERENCE IS IF THE TITLE CHECKLIST IS THE HEADER OF THE TABLE OR JUST A TITLE. -->

  <!-- CHECKLIST -->
	
  <!-- <form name = "checklist" action = "home.php" onsubmit = "return onlyOne(checkbox), return btnClicked(submit)" method = "POST"> -->
  <div class="row">
    <div class="col-md-2"></div>
      <div class="table-container col-md-8">
        <table class="table table-striped main-table">
          
          <thead>
            <tr>
              <th>Course Number</th>
              <th>Term Taken</th>
              <th> Status </th>
              <th> Grade </th>
              <th> Included for GWA computation? </th> 
              <th> Edit </th>
              <th>To Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $list_query = "SELECT * FROM checklist INNER JOIN course ON checklist.COURSE_NUM=course.COURSE_NUM";
              $result = mysqli_query($con, $list_query);
              //$rownum = 0; //row number starts at 0
              while($row=mysqli_fetch_array($result))
              {
            ?>
            <tr>
              <td><?php echo $row['COURSE_NUM'] ?></td>
              <td><?php echo $row['TERM_TAKEN'] ?></td>
              <td><?php echo $row['STATUS'] ?></td>
              <td><?php echo $row['GRADE'] ?></td>
              <td><?php echo $row['TO_COMPUTE'] ?></td>
              <td><a href="editcourse.php?coursenum=<?php echo $row['COURSE_NUM']; ?>">Edit</a></td>    
              <td>
                <a href="home.php?delete=<?php echo $row['COURSE_COUNTER']; ?>" onclick="return confirm('Are you sure?');">
                <img src="images/bin.png" id="delete" style="width:20px;height:20px;">
                </a>
              </td>
            </tr>
          </tbody>
          <?php	
            }	
            if (isset($_GET['delete'])) {
              $delete_id = $_GET['delete'];
              mysqli_query($con, "DELETE FROM checklist WHERE COURSE_COUNTER='$delete_id'");
              echo "<script>alert('Successfully deleted!')</script>";
              header("refresh:0; url=home.php");
            }

          ?>
          <!-- for delete button: need to refresh for delete to take place after clicking button-->
          <!-- </form> -->
          <?php
            if(isset($_POST['delete'])){
              $num_of_check = count($_POST['check']);
              $i = 0;
              if ($num_of_check > 0) {
                while ($i<$num_of_check) {
                  $key_to_del = $_POST['check'][$i];
                  $delete_query = "DELETE from checklist where COURSE_COUNTER ='$key_to_del'";
                  mysqli_query($con,$delete_query);
                  $i++;
                }
              }
              else{
                echo '<script>alert("Please select a course to delete")</script>';
              }
            }
          ?>
        </table>
      </div>
    <div class="col-md-2"></div>
  </div>

  
<!--   <script>
      function onlyOne(checkbox){
        var checkboxes = document.getElementsByName('check');
        checkboxes.forEach((item) => { if (item !== checkbox) item.checked = false});
      }
  </script> -->
	
</body>
</html>

<!--
Code Reference:
https://www.tutorialspoint.com/php/mysql_select_php.htm
SAIS_ID, STUDENT_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME
-->	