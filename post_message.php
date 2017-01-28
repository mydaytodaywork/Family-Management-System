<?php
$text=$_POST['message'];
$sender=$_POST['sender'];
$receiver=$_POST['receiver'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$time=time();	
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="INSERT INTO message VALUES( ";
$query.="'{$sender}','{$receiver}',{$time},'{$text}',0);";
$result=mysqli_query($connection,$query);
if($result)
{
	echo "yes";	
}

else
{
	echo "fail";	
}
?>