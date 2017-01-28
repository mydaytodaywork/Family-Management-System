<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM  cars WHERE userID='{$userID}' ;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{
	?>
	<tr>
	<td><?php echo $row['vehicle_name'];?></td>
	<td><?php echo $row['type'];?></td>
	<td><?php echo $row['vehicle_number'];?></td>
	<td><a href="<?php echo $row['bill']?>" colspan="2">Click Here</a></td>
	</tr>
	<?php }?>
