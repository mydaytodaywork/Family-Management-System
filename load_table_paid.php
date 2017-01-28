<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$dbhost='localhost';
$insuranceID=$_POST['insurance_ID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM insurance_action  WHERE insurance_ID='{$insuranceID}' ;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{
	?>
	<tr data-accountid="<?php echo $row['insurance_ID']?> ">
	<td><?php echo $row['ammount']?></td>
	<td><?php echo $row['date'];?></td>
	<td ><a href="<?php echo $row['bill']?>">Click Here</a></td>
	
	
	</tr>
	<?php }?>
