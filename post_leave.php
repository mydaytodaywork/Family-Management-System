<?php
	include("includes/functions.php");
	if(!isset($_POST['addleave']))
	{
		header('Location:profile.php');	
	}
	
	//database conncection
	else
	{
		check_session();
		include("includes/connection.php");
		$dbname="fs_".$_SESSION['familyID'];
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		$query="INSERT INTO leave_job values('";
		$query.="{$_SESSION['username']}','";
		$query.="{$_POST['jobname']}','";
		$query.="{$_POST['leavedate']}',";
		$query.="{$_POST['duration']},'";
		$query.="{$_POST['leaveletter']}','";
		$query.="{$_POST['leavedesc']}');";
		$chk=mysqli_query($connection,$query);
		header("Location:profile.php?leave=updated");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
