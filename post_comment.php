<?php
$postID=$_POST['postID'];
$userID=$_POST['userID'];
$content=$_POST['content'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$time=time();	
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="INSERT INTO comments(userID,postID,time,content) VALUES( ";
$query.=" '{$userID}',{$postID},'{$time}','{$content}')";
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