<?php 
session_start();
if(isset($_SESSION['username']))
{
	
	header('location:profile.php');	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Family Portal</title>
<link rel="icon" type="image/ico" href="images/favicon.ico">
<link rel="stylesheet" href="stylesheets/login.css"/>
<style>
#family_logo{
	position:absolute;
	top:100px;
	right:90px;
}

body{
	background:linear-gradient(80deg,#c1c9e3,#849ae1);
}
</style>
</head>

<body>
<div id="header">
		<h1 style="display:inline-block">Family portal</h1>
		<div id="signup">
				<p>Not having an account?</p>
				<a href="sign_up.php">Sign Up</a> </div>
</div>
	
		
		
<div id="login">
		<form action="profile.php" method="POST">
				<div class="row">
						<label for="username">Username</label>
						<input name="username" type="text" class="input" />
				</div>
				<div id="clear"></div>
				<div class="row">
						<label for="Password">Password</label>
						</label>
						<input name="password" type="password" class="input" />
						
				</div>
				<div id="clear"></div>
				<div class="row">
						<label for="familyID">FamilyID</label>
						<input name="familyID" type="text" class="input" />
				</div>
				<div id="clear"></div>
				<div >
					<input type="submit"  name="submit" value="Login" id="button" / >
				</div>
		</form>
</div>
<div id="family_logo">
	<img src="images/family_logo.png">
</div>
</body>
</html>