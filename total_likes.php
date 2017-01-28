<?php 
include("includes/functions.php");
$postID=$_POST['postID'];
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;	
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT userID FROM like_posts WHERE postID={$postID};";
$result=mysqli_query($connection,$query);
$users=array();
while($row=mysqli_fetch_assoc($result))
{
	$users[]=$row['userID'];
}
if(count($users)==0)
die("");
?>
<?php
if(in_array($userID,$users))
{
	//unset($array[array_search('strawberry',$array)]);
	if(count($users)==1)
	{
		echo "You like this";	
	}
	else
	{?>
	You and <div style="display:inline" class="hover_like_people"><?php echo count($users)-1;?> other</div> likes this
	<div style="width:0;height:0;position:relative;display:none;" class="like_people_list1">
	<div class="like_people_list">
	<?php 
	foreach($users as $user)
	{if($user==$userID)
		continue;?>
		
		<div class='like_people' data-userid='{$user}'><a href="other_profile.php?others=<?php echo $user ?>"><?php echo get_name($connection,$user)?></a></div>	
	<?php }?> 
	</div>
	</div>
	<?php }}?>
<?php
if(!in_array($userID,$users)){
	?>
	<div style="display:inline" class="hover_like_people"><?php echo count($users);?> people</div> likes this 
	<div style="width:0;height:0;position:relative;display:none;" class="like_people_list1">
	<div class="like_people_list">
	<?php 
	foreach($users as $user) 
	{?>
		<div class='like_people' data-userid='{$user}'><a href="other_profile.php?others=<?php echo $user ?>"><?php echo get_name($connection,$user)?></a></div>	
	<?php }?>
	</div> 
	</div> 
	<?php }?>