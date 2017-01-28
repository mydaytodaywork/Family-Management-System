<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$dbhost='localhost';
$accountID=$_POST['accountID'];
$type=$_POST['type'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM account_action  WHERE account_ID='{$accountID}' AND type='{$type}' ;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{
	?>
	<tr data-accountid="<?php echo $row['account_ID']?> ">
	<td><?php echo $row['date']?></td>
	<td><?php echo $row['deposit'];?></td>
	<td><?php echo $row['withdraw'];?></td>
	<td ><a href="<?php echo $row['bill']?>">Click Here</a></td>
	
	
	</tr>
	<?php }?>
