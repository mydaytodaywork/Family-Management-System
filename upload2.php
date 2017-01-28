<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		session_destroy();
		header('location:login.php');	
	}
	if(count($_POST)>0)
	{
		$userID=$_SESSION['username'];
		$dbname='fs_'.$_SESSION['familyID'];
		$post=$_POST['status'];
		
		//inserting into database
		$time=time();
		include("includes/connection.php");
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		$query="INSERT INTO posts (userID,time,content) VALUES (";
		$query.="'{$userID}','{$time}',";
		$query.="'{$post}');";
		$result=mysqli_query($connection,$query);
		header('location:profile.php');
		if($connection)
		echo $userID."  ".$dbname."   ".$post;
	}

?>