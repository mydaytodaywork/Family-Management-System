<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$otherID=$_POST['otherID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM message WHERE sender='{$otherID}' AND receiver='{$userID}' AND seen=0 ";
$query.="ORDER BY time;";
$result=mysqli_query($connection,$query);
$num_rows = mysqli_num_rows($result);
if($num_rows==0)
{
	die("no");
}
function photo_gen($class,$otherID,$connection)
{
	if($class=="sender")
	{
		$info=getinfo($connection,$otherID);
		$pic=$info["profile_address"];
		echo "<img src='{$pic}' style='width:18px;height:18px;'/ align='center'>";	
	}	
}

?>

<?php while($row=mysqli_fetch_assoc($result))
{
				$class="sender";
		?>
		<div class="<?php echo $class?>"><?php photo_gen($class,$otherID,$connection);?><?php echo $row['text'];?></div>
<?php }?>
<?php 
	$query="UPDATE message SET seen=1 WHERE sender='{$otherID}' AND receiver='{$userID}'";
	$result=mysqli_query($connection,$query);
?>
