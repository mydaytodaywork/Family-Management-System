<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$account_ID=$_POST['account_ID'];
$type=$_POST['type'];
$ammount=$_POST['ammount'];
$action=$_POST['action'];
$deposit=0;
$withdrawl=$ammount;
if($action=="Deposit")
{
	$deposit=$ammount;	
	$withdrawl=0;
}

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


$query="INSERT INTO account_action ";
$query.="(account_ID,type,date,deposit,withdraw,bill) VALUES (";
$query.="'{$account_ID}','{$type}','{$_POST['date']}',{$deposit},{$withdrawl},";
$query.="'uploads/{$name_bill}')";
$result=mysqli_query($connection,$query);

?>