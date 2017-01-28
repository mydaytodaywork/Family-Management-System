<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
//uploading files-------
//car bill
$query="INSERT INTO banking ";
$query.="(account_no,userID,bankname) VALUES (";
$query.="'{$_POST['account_no']}','{$userID}','{$_POST['bank_name']}')";
$result=mysqli_query($connection,$query);

?>