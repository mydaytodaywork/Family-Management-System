<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
//uploading files-------
//1 join letter
$name_join=$_FILES['join_letter']['name'];
$tmp_join=$_FILES['join_letter']['tmp_name'];
$name_leave=$_FILES['resign_letter']['name'];
$tmp_leave=$_FILES['resign_letter']['tmp_name'];
$id=file_id_generator($connection);
$name_join=$id."_".$name_join;
$id++;
$name_leave=$id."_".$name_leave;
if(move_uploaded_file($tmp_join,"uploads/".$name_join))
{
	$query="INSERT INTO uploads ";
	$query.="(userID,address,name) VALUES (";
	$query.="'{$userID}','uploads/{$name_join}','{$name_join}')";
	$result=mysqli_query($connection,$query);
	

}

if(move_uploaded_file($tmp_leave,"uploads/".$name_leave))
{
	$query="INSERT INTO uploads ";
	$query.="(userID,address,name) VALUES (";
	$query.="'{$userID}','uploads/{$name_leave}','{$name_leave}')";
	$result=mysqli_query($connection,$query);
	
}

$query="INSERT INTO serviceparticulars ";
$query.="(userID,job,jobtype,sal,join_letter,leave_letter,startdate,enddate) VALUES (";
$query.="'{$userID}','{$_POST['job']}','{$_POST['type']}', '{$_POST['salary']}',";
$query.="'uploads/{$name_join}','uploads/{$name_leave}','{$_POST['start_date']}',";
$query.="'{$_POST['end_date']}');";
$result=mysqli_query($connection,$query);

?>