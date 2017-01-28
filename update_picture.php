<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$name_pic=$_FILES['photo']['name'];
if(!$name_pic)
{
	die("fail_pic");	
}
$tmp_pic=$_FILES['photo']['tmp_name'];
$id=file_id_generator($connection);
$name_pic=$id."_".$name_pic;
if(move_uploaded_file($tmp_pic,"uploads/".$name_pic))
{
	$query="INSERT INTO uploads ";
	$query.="(userID,address,name) VALUES (";
	$query.="'{$userID}','uploads/{$name_pic}','{$name_pic}')";
	$result=mysqli_query($connection,$query);
	

}
else
die("fail");

//inserting into profile pics
$address="uploads/".$name_pic;
$query="UPDATE profile_pics ";
$query.="SET uploadID={$id} ,address='{$address}' WHERE userID='{$userID}' ;";
$result=mysqli_query($connection,$query);
if($result)
echo "done";
?>