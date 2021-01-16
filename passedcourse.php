<?php
	include ('connection.php');
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
    <table align = "center" border="1px" style="width:600px; line-height:40px;">
      <thead>
        <tr>
			<th colspan="7">
				<h2> List of Passed Courses </h2>
			</th>
		</tr>
      <th> To Delete </th>
			<th> Course Number </th>
			<th> Term Taken </th>
			<th> Status </th>
      <th> Grade </th>
      <th> Included for GWA computation? </th>
      <!-- jen -->
      <th></th>
      <tbody align="center">

<?php
	$sql = "SELECT * FROM `checklist` WHERE STATUS = 'PASSED';";
	$result = mysqli_query($con, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	if ($resultCheck > 0) {
		while ($rows = mysqli_fetch_assoc($result)) {?>
			<tr>
			<td>
				<form action="" method="post">
					<input type="checkbox" name="check[]" id="check" value="<?php echo $rows['COURSE_COUNTER'];?>">
			</td>
				<td align="center"><?php echo $rows['COURSE_NUM'];?></td>
				<td align="center"><?php echo $rows['TERM_TAKEN']; ?></td>
				<td align="center"><?php echo $rows['STATUS']; ?></td>
        <td align="center"><?php echo $rows['GRADE']; ?></td>
        <td align="center"><?php echo $rows['TO_COMPUTE']; ?></td>
        <!-- jen -->
		<td align="center"><a href="editcourse.php?coursenum=<?php echo $rows['COURSE_NUM']; ?>">Edit</a></td> 
    

    </tr>	
	
		<?php } ?>
	<?php } ?>

</tbody>
    </table>
    <br/>
  
  </div>

<!-- for delete button: need to refresh for delete to take place after clicking button-->
  <div class="row">
    <div class="form_group">
      <input type="submit" name="delete" value="Delete">
    </div>
  </div>
        </form>
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




  <br/><br/><a href="home.php">Home</a>

</body>
</html>	

<!--
Code Reference:
https://www.tutorialspoint.com/php/mysql_select_php.htm
SAIS_ID, STUDENT_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME
-->	