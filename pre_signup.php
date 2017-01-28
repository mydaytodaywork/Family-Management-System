<?php require_once("includes/functions.php");?>
<?php 
	if(!isset($_POST['submit']))
	{
		header('Location:sign_up.php');	
	}
	
	//database conncection
	if($_POST['head']==="yes")
	{
		include("includes/connection.php");
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass);
		$dbname="fs_".$_POST["userID"];	
		$query="CREATE DATABASE $dbname;";
		$result=mysqli_query($connection,$query); 
		mysqli_close($connection);
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		//create family table
		create_tables($connection);
		
		//inserting records of head of the family
		
		//inserting into family_info
		$query="INSERT INTO family_info ";
		$query.="(familyID,NoOfMembers,TotalIncome)";
		$query.="VALUES (";
		$query.="'{$dbname}',1,0";
		$query.=");";
		mysqli_query($connection,$query);
		
		//inserting into members
		$query="INSERT INTO members ";
		$query.="VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['sex']}','{$_POST['userID']}','{$_POST['email']}',1);";
		mysqli_query($connection,$query);
		
		//inserting into login
		$query="INSERT INTO login ";
		$query.="VALUES (";
		$query.="'{$_POST['userID']}' ,'{$_POST['password']}' )";
		mysqli_query($connection,$query);
		
		//inserting into income
		$query="INSERT INTO income ";
		$query.="VALUES (";
		$query.=" '{$_POST['userID']}',0 )";
		mysqli_query($connection,$query);
		
		//Signup dates
		$time=time();
		$query="INSERT INTO signup_dates ";
		$query.="VALUES (";
		$query.=" '{$_POST['userID']}','$time' )";
		mysqli_query($connection,$query);
		
		//inserting into DOB
		$query="INSERT INTO DOB ";
		$query.="VALUES (";
		$query.=" '{$_POST['userID']}','{$_POST['dob']}' )";
		mysqli_query($connection,$query);
		
		//inserting into profile pics
		$address="uploads/default.jpg";
		$query="INSERT INTO profile_pics Values (";
		$query.="0,'{$_POST['userID']}','{$address}' )";
		mysqli_query($connection,$query);		
		
	}
	
	else if($_POST['head']==='no')
	{
		print_r($_POST);
		$dbname="fs_".$_POST['FamilyID'];	
		include("includes/connection.php");
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		//checks if connection ocurred
		if(mysqli_connect_errno())
		{
			die("wrong familyID entered");	
		}
		
		//inserting into various tables;
		
		//inserting into members
		$query="INSERT INTO members ";
		$query.="VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['sex']}','{$_POST['userID']}','{$_POST['email']}',0);";
		mysqli_query($connection,$query);
		
		//inserting into login
		$query="INSERT INTO login ";
		$query.="VALUES (";
		$query.="'{$_POST['userID']}' ,'{$_POST['password']}' )";
		mysqli_query($connection,$query);
		
		//inserting into income
		$query="INSERT INTO income ";
		$query.="VALUES (";
		$query.=" '{$_POST['userID']}',0 )";
		mysqli_query($connection,$query);
		
		//Signup dates
		$time=time();
		$query="INSERT INTO signup_dates ";
		$query.="VALUES (";
		$query.=" '{$_POST['userID']}','$time' )";
		mysqli_query($connection,$query);
		
		//inserting into DOB
		$query="INSERT INTO DOB ";
		$query.="VALUES (";
		$query.=" '{$_POST['userID']}','{$_POST['dob']}' )";
		mysqli_query($connection,$query);
		
		//inserting into profile pics
		$address="uploads/default.jpg";
		$query="INSERT INTO profile_pics VALUES(";
		$query.="0,'{$_POST['userID']}','{$address}' )";
		mysqli_query($connection,$query);
		//updating family_info table
		
		$query="SELECT * FROM family_info;";
		$result=mysqli_query($connection,$query);
		$arr=mysqli_fetch_assoc($result);
		$noOfmembers=intval($arr['NoOfMembers']);
		$noOfmembers++;
		$query="UPDATE family_info ";
		$query.="SET NoOfMembers=$noOfmembers; ";
		mysqli_query($connection,$query);
		
		
	}
	header("location:login.php");
	
?>
<?php include("includes/header.php");?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


</body>
</html>