<?php
$postID=$_POST['postID'];
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;	
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT COUNT(*) FROM like_posts WHERE postID={$postID} AND userID='{$userID}' ;";
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_row($result);
if($row[0]==0)
{
	echo "disliked";
}
else
{
	echo "liked";
}
?>