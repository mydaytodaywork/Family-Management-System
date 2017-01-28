<?php
	include('includes/functions.php');
	check_session();// checks if function is live
	$firstname=$_SESSION['firstname'];
	$profile_pic=$_SESSION['user_pic'];
	$otherID=0;
	//get all  the posts
	$userID=$_SESSION['username'];
	$familyID=$_SESSION['familyID'];
	$dbname='fs_'.$_SESSION['familyID'];
	include("includes/connection.php");
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	
	//retrieving all data
	$query="SELECT m.firstname,m.lastname,p.time,p.content,p.userID,p.postID,p.files,p.address FROM posts AS p,members AS m ";
	$query.=" WHERE p.userID=m.userID ORDER BY p.time DESC;";
	$result=mysqli_query($connection,$query);
	
	//retrieving name of the family members
	$query="SELECT firstname,lastname,userID FROM members WHERE userID <>'{$userID}';";
	$result1=mysqli_query($connection,$query);
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Family Portal</title>
<link rel="icon" type="image/ico" href="images/favicon.ico">
<link rel="stylesheet" href="stylesheets/home.css"/>
<script src="javascript/jquery-1.11.3.min.js"></script>
<style>
div.pcorrect{
		color:red;
		display:inline-block;
	}
	
	pre{
		font-size:16px;
		font-family:Georgia, "Times New Roman", Times, serif;

		}
</style>

</head>
<body>
<div id="header">
		<h1> Family Portal </h1>
		<div id="searchbox">
				<input type="text" name="search" placeholder="search for anything" id="search" />
		</div>
		<div id="menubar">
				<div class="menu"> <a href="profile.php"><img src="<?php echo $profile_pic;?>" style="width:18px;height:18px;"/ align="center"><?php echo $firstname;?></a> </div>
				<div class="menu active"> <a href="home.php">Home</a> </div>
				<div class="menu message" tabindex="1" id="inter"> <a><img id="mes" src="images/black.png" /></a> </div>
				<div class="menu"> <a href="logout.php">Logout</a> </div>
		</div>
</div>
<div id="main">
		<div id="status">
		<div class="tarea">
		<img src="<?php echo $profile_pic?>" class="thumbnail" align='middle' style="margin-top:12px;margin-right:0;"/>
				<textarea placeholder="Whats on your mind?" id="input" rows="7" cols="60" form="form1" name="status"></textarea></div>
				<form  method="post" id="form1" enctype="multipart/form-data">
				<img src="images/photos.png"  id="uphoto" align='center'/>
				<div class="pcorrect"></div>
						<input type="submit" value="POST" name="post" id="button2" />
						<div class="clear"></div>
						
						<input type="file" name="post_photo" style="display:none;" />
				</form>
		</div>
		<?php
		while($row=mysqli_fetch_assoc($result)){
			$info=getinfo($connection,$row['userID']);
		?>
		<div class="wrap" data-postid="<?php echo $row['postID'];?>">
				<div class="wrap1">
						<div class="name clear"> <img src="<?php echo $info["profile_address"]?>" class="thumbnail" align='middle' /> <span><?php echo $row['firstname']." ".$row['lastname'];?></span> </div>
						<div class="date clear"> <span><?php echo strftime("%#d %B %Y",$row['time']);?></span> <span class="time"><?php echo strftime("%I:%M:%S %p",$row['time']);?></span> </div>
						<div class="content clear"> <pre><?php echo htmlentities($row['content']);?></pre> </div>
						<div style="max-height:500px;overflow:hidden">
						<?php 
							if($row['files']==1)
							{
								echo "<img src='{$row['address']}' width='540'>";	
							}
						?>
						</div>
				</div>
				<div class="post_options">
						<div class="likes" data-postid="<?php echo $row['postID'];?>"> <img src="images/grey_like.png" align="center" /> Like</div>
						<div class="comm" data-postid="<?php echo $row['postID'];?>">
		 <img src="images/message.png" align="center" />				
						Comments</div>
				</div>
				<div class="comments" data-postid="<?php echo $row['postID'];?>">
					<div class="like_comment">
						You and 10 others like this
					</div>
						<div class="write_comment"> <img src="<?php echo $profile_pic;?>" style="width:28px;height:28px;" align="center" />
								<input name="comment" placeholder="write a comment" />
						</div>
						<div class="comment_list">
						
						</div>
				</div>
		</div>
		<?php }?>
</div>
<div id="right"> <img src="images/HELLOM.gif" width="300" />
		<p id="tags">This Portal connects your family</p>
</div>
<div id="left">
		<div id="members">
				<div style="padding:5px;padding-left:15px;"> Your Family Members: </div>
				<?php
		while($row=mysqli_fetch_assoc($result1)){?>
				<a href="other_profile.php?others=<?php echo $row['userID']?>"><div class="people">
	<img src="<?php echo get_pic($connection,$row['userID']);?>" style="width:30px;height:30px;" align="center"/>
	<?php echo $row['firstname']." ".$row['lastname'];?></div></a>
				<?php }?>
		</div>
		<div id="photo"> <img src="images/family2.png" /> </div>
</div>
 <?php include("includes/common1.php");?>
</body>

<script>
//code for uploading pictures photo click
file="none";
$("img#uphoto").click(function(){
		$(this).siblings("input[name='post_photo']").click();
	
	});
	
//image recognition
$("input[name='post_photo']").change(function(){
			var val=$(this).val();
			var ext = val.split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
    			$("div.pcorrect").text("choose image file")
				window.file="none"
			}
			else{
				$("div.pcorrect").text("image file")
				window.file="photo"
				}
		});

//posting data into database
$("form#form1").submit(function(event){
	event.preventDefault();
	//submission code
	if(window.file=='none')
	{
		if($("#input").val()=="")
		return;
	}
	var formData = new FormData($(this)[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		formData.append("file",window.file);
		$.ajax({
			url: "upload.php",
			type: 'POST',
			data:formData,
			async: false,
			success: function (data) {
				location.reload();
			},
			cache: false,
			contentType: false,
			processData: false
		});
				 	
				
});

</script>
<?php include("includes/likes_comment.php");?>
<?php include("includes/messanger.php");?>
</html>