<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$insuranceID=$_POST['insurance_ID'];
$ammount=$_POST['ammount'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
//uploading files-------
//car bill
$name_bill=$_FILES['bill']['name'];
$tmp_bill=$_FILES['bill']['tmp_name'];
$id=file_id_generator($connection);
$name_bill=$id."_".$name_bill;
if(move_uploaded_file($tmp_bill,"uploads/".$name_bill))
{
	$query="INSERT INTO uploads ";
	$query.="(userID,address,name) VALUES (";
	$query.="'{$userID}','uploads/{$name_bill}','{$name_bill}')";
	$result=mysqli_query($connection,$query);
}


$query="INSERT INTO insurance_action ";
$query.="(insurance_ID,date,ammount,bill) VALUES (";
$query.="'{$insuranceID}','{$_POST['date']}',{$_POST['ammount']},";
$query.="'uploads/{$name_bill}')";
$result=mysqli_query($connection,$query);

?>