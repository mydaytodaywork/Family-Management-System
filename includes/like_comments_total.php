<?php 
$text="Like";
$count="";
$query1="SELECT userID FROM like_comments WHERE commentID={$row['commentID']};";
$result1=mysqli_query($connection,$query1);
$users=array();
while($row1=mysqli_fetch_row($result1))
{
	$users[]=$row1[0];	
}
if(in_array($userID,$users))
{
	$text='Unlike';
	$count=count($users);	
}
else
{
	$text='Like';
	$count=count($users);
}

if($count==0)
{
	$count="";	
}

?>