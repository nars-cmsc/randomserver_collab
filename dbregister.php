<?php
include ('connection.php');

//Note: dbregister.php is equal to server.php
//session_start(); //jen removal

// initializing variables
$regupmail = "";
$regpsw = "";
$regsaisid = "";
$regstudid = "";
$regfn = "";
$regmn = "";
$regln = "";

$error; 

// connect to the database
//$db = mysqli_connect($host, $user, $pass, $db);

// REGISTER USER
if (isset($_POST['regacct'])) {
  // receive all input values from the form
  $regupmail = mysqli_real_escape_string($con, $_POST['upemail']);
  $regpsw = mysqli_real_escape_string($con, $_POST['password']);
  $regsaisid = mysqli_real_escape_string($con, $_POST['saisid']);
  $regstudid = mysqli_real_escape_string($con, $_POST['studentid']);
  $regfn = mysqli_real_escape_string($con, $_POST['firstname']);
  $regmn = mysqli_real_escape_string($con, $_POST['middlename']);
  $regln = mysqli_real_escape_string($con, $_POST['lastname']);


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $acct_check_query = "SELECT * FROM student WHERE UP_EMAIL='$regupmail' OR SAIS_ID='$regsaisid' OR STUDENT_ID='$regstudid' LIMIT 1";
  $result = mysqli_query($db, $acct_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['UP_EMAIL'] === $regupmail) {
      echo '<script type="text/javascript">';
      echo 'alert("There is an existing account using the UP email!")';
      echo '</script>';
      $error = true;
    }

    if ($user['SAIS_ID'] === $regsaisid) {
      echo '<script type="text/javascript">';
      echo 'alert("There is an existing account using the SAIS ID!")';
      echo '</script>';
      $error = true;
    }

    if ($user['STUDENT_ID'] === $regstudid) {
      echo '<script type="text/javascript">';
      echo 'alert("There is an existing account using the Student ID!")';
      echo '</script>';
      $error = true;
    }
  }else {
    $error = false;
  }

  // Finally, register user if there are no errors in the form
  if ($error == false) {
  	$encryptpsw = md5($regpsw);//encrypt the password before saving in the database

    $loginquery = "INSERT INTO login (UP_EMAIL, PASSWORD) 
          VALUES('$regupmail', '$encryptpsw')";
    mysqli_query($con, $loginquery); 
  	$studquery = "INSERT INTO student (SAIS_ID, STUDENT_ID, LAST_NAME, FIRST_NAME, MIDDLE_NAME, UP_EMAIL) 
  			  VALUES('$regsaisid', '$regstudid', '$regln', '$regfn', '$regmn', '$regupmail')";
  	mysqli_query($con, $studquery);
  	$_SESSION['UP_EMAIL'] = $regupmail;
  	$_SESSION['success'] = "You are now logged in!";
  	echo '<script type="text/javascript">';
    echo 'alert("Your account is successfully registered! You may now login using your account.")';
    echo '</script>';
  	header('Location: home.php');
  }
}

// /*
// LOGIN USER
if (isset($_POST['loginbtn'])) {
  $logupmail = mysqli_real_escape_string($con, $_POST['upemail']);
  $logpsw = mysqli_real_escape_string($con, $_POST['password']);

  if (empty($logupmail)) {
    $error = true;
  } else
  if (empty($logpsw)) {
    $error = true;
    //array_push($errors, "Password is required");
  } else {
    $error = false;
  }

  if ($error == false) {
    $encryptpsw = md5($logpsw);
    $query = "SELECT * FROM login WHERE UP_EMAIL='$logupmail' AND PASSWORD='$encryptpsw'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) { //if upemail and password are correct, generate token
    //THEN WE MUST CHECK TOKEN

      //generate token
      $token = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 10)), 0, 10);

      //CHECK TOKEN MUST BE HERE
/*      
      $checktoken = "SELECT TOKEN FROM usersession WHERE UP_EMAIL='$logupmail' AND PASSWORD='$logpsw'";
      $tokenresult = mysqli_query($con, $checktoken);
      $tokenvalue = $tokenresult['TOKEN'];
*/
      //if token value is not equal to newly generated token, automatic close?????
      //the line is if result > 0 then update the table
      //proceeds to insert new token for current session
      //store token in session var
      //update user token
      $tokenresult = mysqli_query($con, "SELECT COUNT(*) AS info from usersession where UP_EMAIL='$logupmail'");
      $infoupdate = mysqli_fetch_assoc($tokenresult);
      if($infoupdate['info'] > 0){
        mysqli_query($con, "UPDATE usersession SET TOKEN='$token' WHERE UP_EMAIL='$logupmail'");
      }//else{
        mysqli_query($con, "INSERT INTO usersession(UP_EMAIL, TOKEN) VALUES('$logupmail', '$token')");
      //}
    
      $_SESSION['upemail'] = $logupmail;
      $_SESSION['token'] = $token;
      $_SESSION['success'] = "You are now logged in!";
      header('Location: home.php');
    }else {
      echo '<script type="text/javascript">';
      echo 'alert("Wrong email and password combination!")';
      echo '</script>';
    }
  }
}
// */
?>