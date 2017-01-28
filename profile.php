<?php
	include("includes/functions.php");
	
	//checks if comes from login.php
		check();
		$otherID=0;
		$userID=$_SESSION['username'];
		$familyID=$_SESSION["familyID"];
		include("includes/connection.php");
		$dbname="fs_".$_SESSION["familyID"];	
		$connection=@mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		$info=getinfo($connection,$_SESSION['username']);
		$_SESSION['firstname']=$info['firstname'];
		$firstname=$_SESSION['firstname'];
		$profile_pic=$info["profile_address"];
		$_SESSION['user_pic']=$profile_pic;
		$query="SELECT m.firstname,m.lastname,p.time,p.content,p.userID,p.postID,p.files,p.address FROM posts AS p,members AS m ";
	$query.=" WHERE p.userID=m.userID AND p.userID='{$userID}' ORDER BY p.time DESC;";
	$result=mysqli_query($connection,$query);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $info['firstname']." ".$info['lastname']?></title>
<link rel="icon" type="image/ico" href="images/favicon.ico">
<link rel="stylesheet" href="stylesheets/home.css"/>
<link rel="stylesheet" href="stylesheets/login.css"/>
<script src="javascript/jquery-1.11.3.min.js"></script>
<style>
body{
		background:#aab7e2;
	}
#left1{
		background:#aab7e2;
		position:absolute;
		width:300px;
		height:100%;
		left:0;
		top:304px;
	}
#profile_info{
		height:auto;
		width:250px;
		margin-left:20px;
		border-radius:5px;
		background:#fff;
		padding-top:5px;
		padding-bottom:5px;
		margin-top:20px;
	}
#profile_info div{
		background:#fff;
		padding:5px;
		border-bottom:1px solid rgba(0,0,0,.3);
		
	}
	
#profile_info div span{
		color:#09C;
	}
#main{
		left:350px;
		top:304px;
	}
#right1{
		position:absolute;
		top:304px;
		right:20px;
		width:280px;
		background:#fff;
		padding:10px;
		border-radius:8px;
	}
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
	<h1>
		Family Portal
	</h1>
	<div id="searchbox">
		
			<input type="text" name="search" placeholder="search for anything"  id="search" />
			
			
	</div>
	<div id="menubar">
		<div class="menu active">
			<a href="profile.php"><img src="<?php echo $profile_pic;?>" style="width:18px;height:18px;"/ align="center"><?php echo $info['firstname'];?></a>
		</div>
		<div class="menu ">
			<a href="home.php">Home</a>
		</div>
		<div class="menu message" tabindex="1">
			<a><img id="mes" src="images/black.png" /></a>
		</div>
		<div class="menu">
			<a href="logout.php">Logout</a>
		</div>
		
	</div>
</div>
<div id="wall-picture"> 
    <img src="images/profile/header.jpg" style=" margin-left:30px; height:300px; width:1300px">
	<div class="profile_pic"><img src="<?php echo $profile_pic;?>" />
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="photo" id="photo"/>
	</form>
	<div id="update_pic">Update photo</div>
	<div id="update_icon"><img src="images/upload_icon.png" /></div>
	</div>
	<div class="display">
		<span><?php echo $info['firstname']." ".$info['lastname']?></span>
	</div>
	
</div>

 <div id="left1">
 	<div id="profile_info">
		<div>
			<span>FamilyID:</span>
			<?php
                	echo $info['familyID'];
				?>
		</div>
		<div>
			<span>Sex:</span>
			<?php
                	echo $info['sex'];
				?>
		</div>
		<div>
			<span>Email:</span>
			<?php
                	echo $info['email'];
				?>
		</div>
		<div>
			<span>Phone no:</span>
			<?php
                	if(isset($info['phone'])){
						echo $info['phone'];
						}
					else{
						echo 'Not Available';
						}
				?>
		</div>
		<div>
			<span>Date of Birth:</span>
			<?php
                	if(isset($info['dob'])){
						echo $info['dob'];
						}
					else{
						echo 'Not Available';
						}
				?>
		</div>
		<div>
			<span>Address:</span>
			<?php
                	if(isset($info['address'])){
						echo $info['address'];
						}
					else{
						echo 'Not Available';
						}
				?>
		</div>
	</div>
	<div class="details">
		<div class="menu1" id="click">
			Personale Details
		</div>
		
		<div class="dropdown">
			<div class="menu1">
			<a href="service_details.php">Service Details</a>
		</div>
		<div class="menu1">
			<a href="banking_details.php">Banking Details</a>
		</div>
		<div class="menu1">
			<a href="insurance_details.php">Insurance Details</a>
		</div>
		<div class="menu1">
			<a href="vehicle_details.php">Vehicle Details</a>
		</div>
		</div>
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
    
 <div id="right1">
 	<div>
			<img src="images/family.png" alt="family" style="width:250px;margin-bottom:20px; " />
            
        <div style="border-top:1px solid rgba(0,0,0,.3);padding:10px;">This family portal is designed by <a href="https://www.facebook.com/kamal.rockz" style="text-decoration:none;">Kamal Agrawal</a> and <a href="https://www.facebook.com/atulit.kumar" style="text-decoration:none"> Atulit Kumar</a>. A website which can keep track of a family's record.</div>
    </div>
 </div>
    
    
    
<?php include("includes/common1.php");?> 
</body>


<script>
	$(document).ready(function(){
		$('#click').click(function(){
				$('.dropdown').toggle(2000);
			});
	});
	
	

//code for searching people

	
//display profile picture scripting
$("div.profile_pic").hover(function(){$("#update_pic").stop(true,true).slideDown(500);
		$("#update_icon").stop(true,true).slideDown(500)
},function(){
		$("#update_pic").slideUp(500);
		$("#update_icon").slideUp(500)
	});	

$("#update_icon").click(function(){$("#photo").click();	
});	

$("#update_pic").click(function(){
		var formData = new FormData($(".profile_pic form")[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		$.ajax({
			url: "update_picture.php",
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
	$("#new_message").hide();
</script>
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