<?php
	include("includes/functions.php");
	
	//checks if comes from login.php
	
	if(isset($_POST['username']))
	{
		//checks login database
		include("includes/connection.php");
		$dbname="fs_".$_POST["familyID"];	
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		$query="SELECT password FROM login WHERE userID="."{$_POST['username']}";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_row($result);
		//checks the password
		if($_POST['password']!=$row[0])
		{
			header('location:login.php?attempt=false');	
		}
		else
		{
			session_start();
			$_SESSION=$_POST;	
		}
		
	}
		$dbhost='localhost';
		$dbuser='root';$dbpass="atulit";
		$dbname="fs_".$_POST["familyID"];	
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		$info=getinfo($connection,$_POST['username']);
	 $info['dob'];
?>