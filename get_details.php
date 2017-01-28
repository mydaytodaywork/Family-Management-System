<?php
include("includes/functions.php");
$otherID=$_POST['otherID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID ;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$info=getinfo($connection,$otherID);
echo $info['firstname']." ".$info['lastname'];
?>