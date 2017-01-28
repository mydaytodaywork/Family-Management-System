<?php 
include("includes/functions.php");
$postID=$_POST['postID'];
$userID=$_POST['userID'];
//$content=$_POST['content'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT * FROM comments WHERE postID={$postID} ORDER BY time;";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result))
{	
	include("includes/like_comments_total.php");
	$href="";
	$info=getinfo($connection,$row['userID']);
	//href attribute
	if($userID==$row['userID'])
	{
		$href="profile.php";
	}
	else
	{
		$href="other_profile.php?others={$row['userID']}";	
	}
?>
<div class="comments_user" data-commentid="<?php echo $row['commentID']?>" data-postid="<?php echo $postID; ?>">
	<div style="position:relative">
		<div class="comment_photo">
			<img src="<?php echo $info["profile_address"];?>" style="width:30px;height:30px;" align="center"/>
		</div>
		<div class="comment_content">
			<div class="comment_text">
				<a href="<?php echo $href;?>"><span data-userid="<?php echo $row['userID']?>"><?php echo $info['firstname']." ".$info['lastname'];?></span></a>
<?php echo $row['content']?>
			</div>
			
			<div class="comment_bottom" data-postid="<?php echo $postID; ?>" data-commentid="<?php echo $row['commentID']?>" data-time="<?php echo $row['time'];?>">
				<div class="comment_like"><?php echo $text;?></div>
				<div class="nooflikes"><img src="images/like_comment.png" /><div style="display:inline"><?php echo $count;?></div></div>
				<div class="comment_time"><?php echo gettime($row['time']);?></div>
			</div>
		</div>
		
		
	</div>
</div>
<?php }?>