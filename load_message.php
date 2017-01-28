<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$otherID=$_POST['otherID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM message WHERE (sender='{$userID}' AND receiver='{$otherID}') OR ";
$query.="(sender='{$otherID}' AND receiver='{$userID}') ORDER BY time ASC;";
$result=mysqli_query($connection,$query);
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
	if($row['sender']==$userID)
	{
		$class="me";	
	}
	else{
			$class="sender";
		}?>
		<div>
		
		<div class="<?php echo $class?>"><?php photo_gen($class,$otherID,$connection);?><?php echo $row['text'];?></div>
		
		</div>
<?php }?>

<?php 
	$query="UPDATE message SET seen=1 WHERE sender='{$otherID}' AND receiver='{$userID}'";
	$result=mysqli_query($connection,$query);
?>
