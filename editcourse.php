<?php
include ('connection.php');
include ('tokencheck.php');

if(count($_POST) > 0){
    mysqli_query($con, "UPDATE checklist set TERM_TAKEN='".$_POST['termtaken']."', STATUS='".$_POST['status']."' WHERE COURSE_NUM = '".$_POST['coursenumber']."'");
    $message = "Record modified successfully!";
    header('Location: home.php');
}
$get_item = "SELECT * FROM checklist WHERE course_num ='".$_GET['coursenum']."'; ";
$result = mysqli_query($con, $get_item);
$row = mysqli_fetch_array($result);

?>

<html>
<head>
	<title>PHP Edit Course in Checklist System</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">
</head>
<body>
	<div id = "frm">
		<h1>Edit Course Details in Checklist</h1>
		<form name = "editcourse" action = "editcourse.php" onsubmit = "return validation()" method = "POST">
            <p>
				<label> Course Number: </label>
				<br>
			<input type = "text" id = "coursenumber" name = "coursenumber" value="<?php echo $row['COURSE_NUM']; ?>" readonly>
 			</p>
            <p>
				<label for="termtaken"> Term Taken: </label>
				<br>
 			<select id="termtaken" name="termtaken">
          		<option value="<?php echo $row['TERM_TAKEN']; ?>"></option>
          		<option value="FIRST SEM 2020-2021">FIRST SEM 2020-2021</option>
          		<option value="SECOND SEM 2020-2021">SECOND SEM 2020-2021</option>
          		<option value="MIDYEAR 2021">MIDYEAR 2021</option>
          		<option value="FIRST SEM 2021-2022">FIRST SEM 2021-2022</option>
          		<option value="SECOND SEM 2021-2022">SECOND SEM 2021-2022</option>
          		<option value="MIDYEAR 2022">MIDYEAR 2022</option>
        	</select>
 			<p>
 				<label for="status"> Status: </label>
				<br>
			<select id = "status" name = "status">
        		<option value="<?php echo $row['STATUS']; ?>"></option>
        		<option value="ONGOING">ONGOING</option>
        		<option value="PASSED">PASSED</option>
        		<option value="FAILED">FAILED</option>
      		</select>
      		</p>
<!--jen -->
      		<p>
        		<label for="grade"> Grade: </label>
        		<br>
      		<input type = "text" id = "grade" name = "grade" onkeypress="return isNumber(this, event);">
        		<h5>If you are currently taking the course, just set this to 0 for now. You may update this later by deleting previous record and re-adding this again to checklist.</h5>
      		</p>
      		<p>
        		<label for="yon"> Include this course for automatic GWA Computation? </label>
        		<br>
      		<select id = "yon" name = "yon">
        		<option value=""></option>
        		<option value="YES">YES</option>
        		<option value="NO">NO</option>
      		</select>
      		</p>
<!--jen -->      		

 			<p>
			
				<input type = "submit" id = "btn" name = "addbtn" value = "Edit Course">
	
			</p>

		</form>
	</div>
  	
  	<a href="home.php">Return to Dashboard</a>
	
	<script>
//whole script is jen
    function isNumber(txt, evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
    function isGrade(){
      var input = document.addcourse.grade.value;
      if (input != 0.00 || (input<1.00 && input>5.00)){
        alert("Make sure your input is a valid grade that is either 0 or ranges from 1.00 to 5.00");
        return false;
      }
    }
    function validation(){
      var cno = document.addcourse.courseno.value;
      var cterm = document.addcourse.termtaken.value;
      var cstat = document.addcourse.status.value;
      var cgrade = document.addcourse.grade.value;
      var cyn = document.addcourse.yon.value;
      if(cno.length=="" || cterm.length=="" || cstat.length=="" || cgrade=="" || cyn=""){
        alert("Please fill up all empty fields!");
        return false;
      }
    }    
	</script>

</body>
</html>