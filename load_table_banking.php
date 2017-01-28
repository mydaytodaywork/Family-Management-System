<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$dbhost='localhost';
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM  banking WHERE userID='{$userID}' ;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{
	?>
	<tr data-accountid="<?php echo $row['account_ID']?>" data-account_no="<?php echo $row['account_no']?>"">
	<td><?php echo $row['bankname'];?></td>
	<td><?php echo $row['account_no'];?></td>
	<td class="account" data-type="saving"><span>Click Here</span></td>
	<td class="account" data-type="fixed"><span>Click Here</span></td>
	<td class="account" data-type="current"><span>click Here</span></td>
	
	</tr>
	<?php }?>
