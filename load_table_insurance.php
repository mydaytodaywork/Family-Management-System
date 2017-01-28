<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$dbhost='localhost';
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM  lifeinsurance WHERE userID='{$userID}' ;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{
	?>
	<tr data-insid="<?php echo $row['insurance_ID']?>" data-ins_no="<?php echo $row['insurance_no']?>"">
	<td><?php echo $row['companyname'];?></td>
	<td><?php echo $row['insurance_no'];?></td>
	<td><?php echo $row['years'];?></td>
	<td><?php echo $row['annual_deposit'];?></td>
	<td><?php echo $row['plan_type'];?></td>
	<td><a href="<?php echo $row['papers'];?>">Click Here</a></td>
	<td class="account">Click Here</td>
	</tr>
	<?php }?>
