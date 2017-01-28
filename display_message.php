<?php
include("includes/functions.php");
$userID=$_POST['userID'];
$familyID=$_POST['familyID'];
include("includes/connection.php");
$dbname="fs_".$familyID;
$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$query="SELECT  sender,time FROM message WHERE receiver='{$userID}' ORDER BY time DESC";
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);
if($count==0)
{
	die("no");	
}
	$arr=array();

	while($row=mysqli_fetch_assoc($result))
	{
		
		$id=$row['sender'];
		if(in_array($id, $arr))
		{continue;}
		$info=getinfo($connection,$row['sender']);
		$query1="SELECT text FROM message WHERE receiver='{$userID}' AND sender='{$id}' ORDER BY TIME DESC;";
		$result1=mysqli_query($connection,$query1);
		$row2=mysqli_fetch_assoc($result1);
		$text=$row2['text'];
		$text = (strlen($text) > 13) ? substr($text,0,10).'...' : $text;
		?>
		<div class="messx" data-person="<?php echo $id ;?>">
		<div class="send_name" ><?php echo $info['firstname']." ".$info['lastname'];?></div>
		<div class="text"><?php echo $text?></div>
		</div>
		
		<?php 
			$arr[]=$id;
		}?>
		
		

