<?php

include ('dbdelcourse.php');
include ('tokencheck.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>List of Courses</title>
  <link rel="stylesheet" href="..\bootstrap-3.4.1-dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="..\bootstrap-3.4.1-dist\js\bootstrap.min.js">
  <link rel = "stylesheet" type = "text/css" href = "main_css.css">
  <script type="text/javascript" src="jquery-3.5.1.js"></script>
  <script>
    $(document).ready(function(){
      $('#checkAll').click(function(){
        if (this.checked) {
          $('.checkbox').each(function(){
            this.checked = true;
          });
        }
        else{
          $('.checkbox').each(function(){
            this.checked = false;
          });
        }
      });

      $('#delete').click(function(){
        var array = [];
        if ($('input:checkbox:checked').length > 0 && confirmation() == true) {
          $('input:checkbox:checked').each(function(){
            array.push($(this).attr('id'));
            $(this).closest('tr').remove();
          });
          send_response(array);
          console.log(array);
        }
        else if ($('input:checkbox:checked').length <= 0){
          alert('No course selected');
        }
        else{
          window.location.reload();
        }
      });

      function send_response(array){
        $.ajax({
          type   : 'post',
          url    : 'dbdelcourse.php',
          data   : {array : array},
          success: function(response){
            alert(response);
          },
          error  : function(errResponse){
            alert(errResponse);
          }
        });
      }
      function confirmation(){
        var x = confirm("Are you sure you want to delete the selection?");
        if(x == true){
          return true;
        }
        else{
          return false;
        }
      }
    });
  </script>
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
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <h2 class="form-header">List of Courses</h2>
      <table class="table table-striped main-table" >
        <thead>
          <tr>
            <th><input type="checkbox" id="checkAll"> <span style="margin-left: 3px">Select All</span></th>
            <th>Course Code</th>
            <th>Course Number</th>
            <th>Title of Course</th>
            <th>Number of Units</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while ($row = mysqli_fetch_array($query)) {?>
              <tr>
                <td><input class="checkbox" type="checkbox" name="id[]" id="<?php echo $row['COURSE_CODE']?>"></td>
                <td><?php echo $row['COURSE_CODE'] ?></td>
                <td><?php echo strtoupper($row['COURSE_NUM']) ?></td>
                <td><?php echo ucwords($row['COURSE_TITLE']) ?></td>
                <td><?php echo $row['COURSE_UNITS'] ?></td>
              </tr>
            <?php } ?>
        </tbody>
      </table>
      <button type="button" class="btn btn-danger" id="delete">Delete Selected</button>
    </div>
    <div class="col-md-3"></div>

  </div>  
    
    
    <br/>
    

  

</body>
</html>

<!-- NOTE: The delete button will only work if the course is not included in the checklist because the course code becomes a foreign key etc... -->