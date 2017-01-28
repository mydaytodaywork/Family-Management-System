<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Family Portal</title>
<link rel="icon" type="image/ico" href="images/favicon.ico">
<link rel="stylesheet" href="stylesheets/login.css"/>
<script src="javascript/jquery-1.11.3.min.js"></script>
<script src="javascript/validator.js"></script>
<style>
#login {
	margin-top: 150px;
	width: 30%;
	min-width: 500px;
}
.input {
	width: 70%
}
#fid {
	display: none
}
</style>
</head>

<body>
<div id="header">
<h1 style="display:inline-block">Family portal</h1>
	<div id="signup">
				<p>Are you having an account?</p>
				<a href="login.php">Log In</a> </div>
</div>

		
<div id="login">
		<form action="pre_signup.php" method="post">
				<div class="row">
						<label for="FirstName">First Name</label>
						<input name="firstname" type="text" class="input" />
						<span id="1" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<div class="row">
						<label for="lastname">Last Name</label>
						<input name="lastname" type="text" class="input" />
						<span id="2" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<div class="row">
						<label for="username">Username</label>
						<input name="userID" type="text" class="input" />
						<span id="3" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<div class="row">
						<label for="password">Password</label>
						<input id='p' name="password" type="password" class="input" />
						<span id="4" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<div class="row">
						<label for="repassword">Retype Password</label>
						<input id="rp" name="repassword" type="password" class="input" />
						<span id="5" style="font-size:15px;color:red;float:right;display:none;">password do not match</span> </div>
				<div id="clear"></div>
				<div class="row">
						<label for="email">Email</label>
						<input name="email" type="email" class="input" />
						<span id="6" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<div class="row">
						<label for="dob">Date of Birth</label>
						<input name="dob" type="date" class="input" />
						<span id="7" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<div> Male
						<input type="radio" name="sex" value="male"/>
						Female
						<input type="radio" name="sex" value="female" />
				</div>
				<div> Sign up as a head member
						<input type="radio" class="fmember" name="head" value="yes"/>
						As a Family member
						<input type="radio" class="fmember" name="head" value="no" />
				</div>
				<div id="clear"></div>
				<div class="row" id="fid" >
						<label for="familyId">Family ID</label>
						<input name="FamilyID"  type="text" class="input" />
						<span id="8" style="font-size:15px;color:red;float:right;display:none;">cannot be null</span> </div>
				<div id="clear"></div>
				<input type="submit" name="submit" value="Sign UP" id="button" />
		</form>
</div>
</body>
<script>
$(document).ready(function() {
	$('.fmember').click(function()
	{
		if($("input:radio[name='head']:checked").val()=="yes")
		{
			$('#fid').hide();
			$('#fid input').val('');
				
		}
		else
		{
			$('#fid').show();	
		}
		
			
});

});

$.validator.setDefaults({
		submitHandler: function() {
			$("form").validate();
		}
	});

	$().ready(function() {
		// validate the comment form when it is submitted
		$("form").validate();

		// validate signup form on keyup and submit
		$("form").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				userID: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				repassword: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
				topic: {
					required: "#newsletter:checked",
					minlength: 2
				},
				agree: "required"
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				agree: "Please accept our policy",
				topic: "Please select at least 2 topics"
			}
		});

		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});

		//code to hide topic selection, disable for demo
		var newsletter = $("#newsletter");
		// newsletter topics are optional, hide at first
		var inital = newsletter.is(":checked");
		var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
		var topicInputs = topics.find("input").attr("disabled", !inital);
		// show when newsletter is checked
		newsletter.click(function() {
			topics[this.checked ? "removeClass" : "addClass"]("gray");
			topicInputs.attr("disabled", !this.checked);
		});
	});
</script>
</html>