<?php
include ('dbregcourse.php');
include ('tokencheck.php');

?>

<html>
<head>
	<title>PHP Register Course System</title>
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
	<div class="row">
		<div class="col-md-4"></div>
		
		<div class="col-md-4" id="frm-regcourse">
			
			<h1 class="form-header">Register Course to Database</h1>
			<form name = "regcourse" action = "dbregcourse.php" onsubmit = "return validation()" method = "POST">
				<div class="row field_row">
					<div><input placeholder="Course Code" type="text" id="coursecode" name="coursecode" minlength="5" maxlength="5"></div>
				</div>
				
				<div class="row field_row">
					<div><input placeholder="Course Number" type = "text" id = "courseno" name = "courseno"></div>
				</div>
				
				<div class="row field_row">
					<div><input placeholder="Course Title" type = "text" id = "coursetitle" name = "coursetitle"></div>
				</div>
				<div class="row field_row"> <span style="general-font">Course Units:</span> 
					<select placeholder="Course Units" id="courseunits" name="courseunits">
						<option value=""></option>
						<option>1.00</option>
						<option>2.00</option>
						<option>3.00</option>
						<option>4.00</option>
						<option>5.00</option>
					</select>
				</div>
				<div class="row"><input style="margin-top:10px" type = "submit" class="submit-btn" id = "regcbtn" name = "regcbtn" value = "Register Course"></div>
				<div class="row"><button class="submit-btn" href="home.php" style="margin-top:10px">Return to Dashboard</button></div>
			</form>
				
			
		</div>
		<div class="col-md-4"></div>
	</div>


	<script>
		function validation(){
			var ccode = document.regcourse.coursecode.value;
			var ctitle = document.regcourse.coursetitle.value;
			var cunits = document.regcourse.courseunits.value;
			if(ccode.length=="" || ctitle.length=="" || cunits.length==""){
				alert("Please fill up all empty fields!");
				return false;
			}
		}
	</script>

</body>
</html>