<?php
include ('dbregister.php');

//Note: registration.php = register.php
?>

<html>
<head>
	<title>Registration System</title>
	<link rel="stylesheet" href="..\bootstrap-5.0.0-beta1-dist\css\bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "main_css.css">
</head>
<body>
	<div class="row" style="margin-top: 30px">
		<div class="col-md-4"></div>
		<div class="col-md-4" >
			<div id="frm-reg">
				<h1 class="form-header">Registration Details</h1>
				<form name = "register" action = "registration.php" onsubmit = "return validation()" method = "POST">
					<div class="row field_row">
						<div><input placeholder="UP Email" style="width:80%" type = "email" id = "upemail" name = "upemail" value = "<?php echo $regupmail; ?>"/></div>
					</div>

					<div class="row field_row">
						<div><input placeholder="Password" style="width:80%" type = "password" id = "password" name = "password" value = "<?php echo $regpsw; ?>"/></div>
					</div>
					
					<div class="row field_row">
						<div><input placeholder="SAIS ID" style="width:80%" type = "text" id = "saisid" name = "saisid" onkeypress="return isNumberKey(event)" minlength="8" maxlength="8" value = "<?php echo $regsaisid; ?>" /></div>
					</div>
					
					<div class="row field_row">
						<div><input placeholder="Student ID" style="width:80%" type = "text" id = "studentid" name = "studentid" onkeypress="return isNumberKey(event)" minlength="9" maxlength="9" value = "<?php echo $regstudid; ?>" /></div>
					</div>

					<div class="row field_row">
						<div><input placeholder="First Name" style="width:80%" type = "text" id = "firstname" name = "firstname" value = "<?php echo $regfn; ?>" /></div>
					</div>

					<div class="row field_row">
						<div><input placeholder="Middle Name"  style="width:80%" type = "text" id = "middlename" name = "middlename" value = "<?php echo $regmn; ?>" /></div>
					</div>
					
					<div class="row field_row">
						<div><input placeholder="Last Name"  style="width:80%" type = "text" id = "lastname" name = "lastname" value = "<?php echo $regln; ?>" /></div>
					</div>

					<div class="row field_row" style="margin-top: 8px">
						<div class="col-md-4"></div>
						<div class="col-md-4"><input type = "submit" id = "btn" name = "regacct" value = "Create Account" class="submit-btn"/></div>
						<div class="col-md-4"></div>
						
					</div>					
				</form>
			</div>
		</div>	
		
		<div class="col-md-4"></div>
	
	</div>
	
	<script>
		function validation(){
			var id = document.register.upemail.value;
			var ps = document.register.password.value;
			var sais = document.register.saisid.value;
			var studid = document.register.studentid.value;
			var fn = document.register.firstname.value;
			var mn = document.register.middlename.value;
			var ln = document.register.lastname.value;

			if(id.length=="" || ps.length=="" || sais.length=="" || studid.length=="" || fn.length=="" || mn.length=="" || ln.length==""){
				alert("Please fill in the blank/s with expected input type!");
				<?php $error = true; ?>
				return false;
			} else <?php $error = false; ?>
		}

		function isNumberKey(evt){
    		var charCode = (evt.which) ? evt.which : evt.keyCode
    		if (charCode > 31 && (charCode < 48 || charCode > 57)){
    			<?php echo $error = true; ?>
        		return false;
    		}
    		return true;
    		<?php echo $error = false; ?>
		}

	</script>
</body>
</html>

<!-- Code Reference for:
registration.php
dbregister.php

https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database

https://www.stechies.com/display-alert-message-box-dialogue-box-using-php/

Please note that the codes were copied to serve as a working and starting basis.
The code will be changed as soon as the basic framework is set up.
-->