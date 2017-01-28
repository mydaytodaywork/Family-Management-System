<?php
include('includes/functions.php');
$userID=$_POST['userID'];
$text=$_POST['text'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM members WHERE ((firstname LIKE '%{$text}%' ) OR ";
$query.="(lastname LIKE '%{$text}%') OR (email LIKE '%{$text}%') OR ";
$query.="(userID LIKE '{$text}%')) AND userID <> '{$userID}';";
$result=mysqli_query($connection,$query);
?>
<?php
	while($row=mysqli_fetch_assoc($result))
	{
		$info=getinfo($connection,$row["userID"]);
		$pic=$info["profile_address"];
		?>
	<a href="other_profile.php?others=<?php echo $row['userID']?>"><div class="people">
	<img src="<?php echo $pic;?>" style="width:30px;height:30px;" align="center"/>
	<?php echo $row['firstname']." ".$row['lastname'];?></div></a>
	<?php }?>