<?php

include ('dbdelcourse.php');
include ('tokencheck.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>List of Courses</title>
  <link rel = "stylesheet" type = "text/css" href = "style.css">
  <script type="text/javascript" src="jquery-3.5.1.js"></script>
</head>
<body>
  <div align="center">
    <br />
    <h2>List of Courses</h2>
    <table class="table table-striped" border="1px" style="width:600px; line-height:40px;">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll"></th>
          <th>Course Code</th>
          <th>Course Number</th>
          <th>Title of Course</th>
          <th>Number of Units</th>
        </tr>
      </thead>
      <tbody align="center">
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
    <br/>
    <button type="button" class="btn btn-danger" id="delete">Delete Selected</button>
  </div>

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


  <br/><br/><a href="home.php">Home</a>

</body>
</html>

<!-- NOTE: The delete button will only work if the course is not included in the checklist because the course code becomes a foreign key etc... -->