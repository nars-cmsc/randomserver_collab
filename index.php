<?php
include ('dbregister.php')

  //Note: index.php = login.php (in website reference)
?>
<html>
<head>
	<link rel="stylesheet" href="..\bootstrap-5.0.0-beta1-dist\css\bootstrap.min.css">
	<title>Login System</title>
	<!-- <! -- insert style.css file inside index.php -->
	<link rel = "stylesheet" type = "text/css" href = "..\main_css.css">
</head>
<body>

	<div class="bg"> 
		<div class="row" style="margin-top: 175px">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				
					<div id="frm"class="row">
						<div class="col-md-6 oble_pic">
							<img src="../img/sample.png" class="center" style="height:100%"/>
						</div>
						<div class="col-md-6" style="padding-top: 50px">
							<div class="row" style="margin-left: -25px"><h1 class="form-header">Hello!</h1></div>
							<div class="row general-font" style="margin-bottom: 30px">Welcome! Please input your credentials to log-in.</div>
							<form name = "login" action = "index.php" onsubmit = "return validation()" method = "POST">

								<div class="row">
									<input placeholder="Enter your UP Email here" type = "email" id = "upemail" name = "upemail" style="width:80%"/>
								</div>

								<div class="row" style="margin-top: 5px">
									
									<input placeholder="Enter your password here" type = "password" id = "password" name = "password" style="width:80%"/>
								</div>	

								<div class="row" style="margin-top: 30px">
									<div class="col-md-3" style="margin-left: -11px"><input class="submit-btn" type = "submit" id = "btn" name = "loginbtn" value = "Login" /></div>
									<div class="col-md-9"></div>
								</div>

								<div class="row general-font" style="margin-top: 25px">
									Don't have an account?
									<a href="..\registration.php" style="margin-left:-11px; color: rgb(81, 143, 179)">Sign up here!</a>	
								</div>
							</form>
						</div>
					</div>
				
			
			<div class="col-md-2"></div>
		</div>
	</div>
	
	<!-- validation for empty field -->
	<script>
		function validation(){
			var id = document.login.upemail.value;
			var ps = document.login.password.value;
			if(id.length=="" && ps.length==""){
				alert("UP Email and Password fields are empty!");
				return false;
			}
			else{
				if(id.length==""){
					alert("UP Email field is empty!");
					return false;
				}
				if(ps.length==""){
					alert("Password field is empty!");
					return false;
				}
			}
		}
	</script>
</body>
</html>

<!-- Code Reference for:
 index.php
 style.css
 connection.php
 authentication.php

 https://www.javatpoint.com/php-mysql-login-system 

 Please note that the codes were copied to serve as a working and starting basis.
 The code will be changed as soon as the basic framework is set up.
-->

<!-- 
List of Fucked Up Made-up Accounts, Sais ID, Student ID, and Password
Note: Since user@up was created directly using phpmyadmin, please use the other accounts to login. In addition, user1@up and user2@up seem to be lost accounts... login is not available using them and they cannot be registered again.

	user@up, 10000000, 200000000, 12345

	user1@up, 10000001, 200000001, 1234 or 12345

	user2@up, 10000002, 200000002, 12345

WORKING ACCOUNT:
	user3@up, 10000003, 200000003, 0987
-->