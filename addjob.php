<?php
	include('includes/functions.php');
	check_session();// checks if function is live
	$firstname=$_SESSION['firstname'];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link rel="stylesheet" href="stylesheets/login.css"/>
</head>
	
<body>

	<div id="header">
		<h1 style="float:left;">Family portal</h1>
		<div style="margin-left: 400px; float:right; position:absolute; margin-top:16px; clear:both;">
				<input type="search" size="20" style="width:300px; height:20px;" placeholder="search"  name="searchtext"/>
		</div>
		<div style="margin-left: 720px;  float:right; position:absolute; margin-top:10px; clear:both;">
				<input type="submit"  name="submit" value="Search" id="button" / >
		</div>
		<div class="active menu" style="margin-left: 1000px; float:right; position:absolute; margin-top:8px; clear:both;"> <a href="home.php" style="text-decoration:none; color:#FFF">Home</a> </div>
		<div class="menu" style="margin-left: 1080px; float:right; position:absolute; margin-top:8px; clear:both;"> <a href="profile.php" style="text-decoration:none; color:#FFF"><?php echo $firstname;?></a> </div>
		<div class="menu" style="margin-left: 1160px; float:right; position:absolute; margin-top:8px; clear:both;"> <a href="logout.php" style="text-decoration:none; color:#FFF">Logout</a> </div>
</div>
 <div style=" margin:15px; margin-top:50px; float:left; width:410px; height:auto; background-color:#FFF; margin-left:30px; border-radius:15px;">
    <form action="post_job.php" method="post">
    	<fieldset style="margin:15px;">
        	<legend><p style="font-size:25px;">Personal Details</p></legend>
            <input type="text" style=" margin-top:20px;" class="update" name="jobname" placeholder="JOB NAME">
            <input type="text" class="update" name="jobtype" placeholder="JOBTYPE">
            <p style="margin-top:20px; margin-left:20px;">START DATE:</p><br/>
            <input type="date" class="update" name="startdate" placeholder="startdate" style=" margin-top:0px;"><br/>
             <p style="margin-top:20px; margin-left:20px;">END DATE:</p><br/>
            <input type="date" class="update" name="enddate" placeholder"ENDDATE"  style=" margin-top:0px;">
            
            <input type="integer" class="update" name="sal" placeholder="SALARY">
             <p style="margin-top:20px; margin-left:20px;">ADD JOINING CERTFICATE:</p><br/>
            <input type="file" class="update" name="joinletter" placeholder="Jining" style="margin-bottom:20px;">
            <input type="submit" value="ADD JOB" class="updsub" name="addjob" style=" margin-top:0px;"/>
        </fieldset>
     </form>   
    </div>

</body>
</html>