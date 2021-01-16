<?php
  include ('connection.php');

  $query = mysqli_query($con, "SELECT * FROM course");

  if (isset($_POST['array'])) {

    foreach ($_POST['array'] as $id) {
      mysqli_query($con, "DELETE FROM course WHERE COURSE_CODE='$id'");
    }

    echo "Course deleted successfully!";

  }

?>