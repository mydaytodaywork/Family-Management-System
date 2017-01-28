<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
//uploading files-------
//1 join letter
$name_papers=$_FILES['papers']['name'];
$tmp_papers=$_FILES['papers']['tmp_name'];
$id=file_id_generator($connection);
$name_papers=$id."_".$name_papers;
$id++;
if(move_uploaded_file($tmp_papers,"uploads/".$name_papers))
{
	$query="INSERT INTO uploads ";
	$query.="(userID,address,name) VALUES (";
	$query.="'{$userID}','uploads/{$name_papers}','{$name_papers}')";
	$result=mysqli_query($connection,$query);
	

}
$query="INSERT INTO lifeinsurance ";
$query.="(insurance_no,userID,companyname,plan_type,years,annual_deposit,papers) VALUES (";
$query.="'{$_POST['insurance_no']}','{$userID}','{$_POST['company_name']}', '{$_POST['plan_type']}',";
$query.="{$_POST['years']},{$_POST['annual']},'uploads/{$name_papers}' );";
$result=mysqli_query($connection,$query);
?>