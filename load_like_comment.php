<?php
include('includes/functions.php');
$postID=$_POST['postID'];
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
$commentID=$_POST['commentID'];
include("includes/connection.php");
$dbname="fs_".$familyID;	
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$text="Like";
$count="";
$query="SELECT userID FROM like_comments WHERE commentID={$commentID};";
$result=mysqli_query($connection,$query);
$users=array();
while($row=mysqli_fetch_row($result))
{
	$users[]=$row[0];	
}
if(in_array($userID,$users))
{
	$text='Like';
	$count=count($users)-1;
	$query="DELETE FROM like_comments WHERE commentID={$commentID} AND userID='{$userID}' ;";	
	$result=mysqli_query($connection,$query);	
}
else
{
	$text='Unlike';
	$count=count($users)+1;
	$query="INSERT INTO like_comments VALUES({$commentID},'{$userID}') ;";	
	$result=mysqli_query($connection,$query);
}
if($count==0)
{
	$count="";
}

?>
<div class="comment_like"><?php echo $text;?></div>
				<div class="nooflikes"><img src="images/like_comment.png" /><div style="display:inline"><?php echo $count;?></div></div>
				<div class="comment_time"><?php echo gettime($_POST['time']);?></div>