<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
//uploading files-------
//car bill
$name_bill=$_FILES['car_bill']['name'];
$tmp_bill=$_FILES['car_bill']['tmp_name'];
$id=file_id_generator($connection);
$name_bill=$id."_".$name_bill;
if(move_uploaded_file($tmp_bill,"uploads/".$name_bill))
{
	$query="INSERT INTO uploads ";
	$query.="(userID,address,name) VALUES (";
	$query.="'{$userID}','uploads/{$name_bill}','{$name_bill}')";
	$result=mysqli_query($connection,$query);
	

}


$query="INSERT INTO cars ";
$query.="(userID,vehicle_name,vehicle_number,bill,type) VALUES (";
$query.="'{$userID}','{$_POST['name']}','{$_POST['number']}', 'uploads/{$name_bill}',";
$query.="'{$_POST['type']}');";
$result=mysqli_query($connection,$query);

?>