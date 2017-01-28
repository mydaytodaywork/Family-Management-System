<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$dbhost='localhost';
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM  serviceparticulars WHERE userID='{$userID}' ;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{
	$startime=strtotime($row['startdate']);
	$endtime=strtotime($row['enddate']);
	$duration="From ".strftime("%d %B %Y",$startime)." to ".strftime("%d %B %Y",$startime);
	?>
	<tr>
	<td><?php echo $row['job'];?></td>
	<td><?php echo $row['jobtype'];?></td>
	<td><?php echo $row['sal'];?></td>
	<td><?php echo $duration;?></td>
	<td><a href="<?php echo $row['join_letter']?>" colspan="2">Click Here</a></td>
	<td><a href="<?php echo $row['leave_letter']?>">Click Here</a></td>
	</tr>
	<?php }?>
