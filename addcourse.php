<?php
include ('dbaddcourse.php');
include ('tokencheck.php');
//below is jen
/*
if (!isset($_SESSION['upemail'])) {
    $_SESSION['msg'] = "You must log in first!";
    header('Location: index.php');
  }
*/  
//end of jen

?>

<html>
<head>
  <title>PHP Add Course to Checklist System</title>
  <link rel="stylesheet" href="..\bootstrap-3.4.1-dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="..\bootstrap-3.4.1-dist\js\bootstrap.min.js">
	<link rel = "stylesheet" type = "text/css" href = "main_css.css">
</head>
<body>
  <div id = "frm">
    <h1>Add Course to Checklist</h1>
    <form name = "addcourse" action = "dbaddcourse.php" onsubmit = "return validation()" method = "POST">
      <p>
        <label> Course Number: </label>
        <br>
      <input placeholder="Course Number" type = "text" id = "courseno" name = "courseno">
      </p>
      <p>
        <label for="termtaken"> Term Taken: </label>
        <br>
      <!-- <input type = "text" id = "termtaken" name = "termtaken"> -->
      <select id="termtaken" name="termtaken">
          <option value=""></option>
          <option value="FIRST SEM 2020-2021">FIRST SEM 2020-2021</option>
          <option value="SECOND SEM 2020-2021">SECOND SEM 2020-2021</option>
          <option value="MIDYEAR 2021">MIDYEAR 2021</option>
          <option value="FIRST SEM 2021-2022">FIRST SEM 2021-2022</option>
          <option value="SECOND SEM 2021-2022">SECOND SEM 2021-2022</option>
          <option value="MIDYEAR 2022">MIDYEAR 2022</option>
        </select>
      </p>
      <p>
        <label for="status"> Status: </label>
        <br>
      <select id = "status" name = "status">
        <option value=""></option>
        <option value="ONGOING">ONGOING</option>
        <option value="PASSED">PASSED</option>
        <option value="FAILED">FAILED</option>
      </select>
      </p>
<!--start of jen -->      
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
<!--end of jen -->      
      <p>      
        <input type = "submit" id = "addcbtn" name = "addcbtn" value = "Add Course">
      </p>

    </form>
  </div>

  <a href="home.php">Return to Dashboard</a>

  <script>
//script is whole jen
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
      if(cno.length=="" || cterm.length=="" || cstat.length=="" || cgrade=="" || cyn==""){
        alert("Please fill up all empty fields!");
        return false;
      }
    }    
  </script>

</body>
</html>
