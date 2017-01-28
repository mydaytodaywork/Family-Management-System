<?php
	include('includes/functions.php');
	check_session();// checks if function is live
	if(isset($_GET['others']))
	{
		$userID=$_GET['others'];	
	}
	else
	{
		$userID=$_SESSION['username'];	
	}
	$firstname=$_SESSION['firstname'];
	$profile_pic=$_SESSION['user_pic'];
	//get all  the posts
	
	$familyID=$_SESSION['familyID'];
	$dbname='fs_'.$_SESSION['familyID'];
	include("includes/connection.php");
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	
	//retrieving all data
	$query="SELECT m.firstname,m.lastname,p.time,p.content FROM posts AS p,members AS m ";
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
<link rel="stylesheet" href="stylesheets/login.css"/>
<link rel="stylesheet" href="stylesheets/tables.css"/>
<script src="javascript/jquery-1.11.3.min.js"></script>
<style>
#click{
	margin-top:20px;
	margin-left:40px;
}

div.table_content{
		max-width:430px;
	}
</style>

</head>
<body>
	<div id="header">
	<h1>
		Family Portal
	</h1>
	<div id="searchbox">
		
			<input type="text" name="search" placeholder="search for anything" id="search"/>
			<input type="submit" name="submit" value="search" id="button" />
		
	</div>
	<div id="menubar">
		<div class="menu">
			<a href="profile.php"><img src="<?php echo $profile_pic;?>" style="width:18px;height:18px;"/ align="center"><?php echo $firstname;?></a>
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
<div class="table_content" style="width:auto">
<div id="show_service">
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Number</th>
				<th>Bill</th>
			</tr>
		</thead>
		<tbody>
			
			
		</tbody>
	</table>
</div>
<?php 
if(!isset($_GET['others']))
{
	echo "<div id='click' ><button class='btn' style='width:auto'>Add Vehicle</button></div>";	
}

?>
</div>



<div id="update_service" >
	<form method="post" enctype="multipart/form-data">
		<input type="text" name="name" placeholder="Name" />
		<input type="text" name="number" placeholder="Number" />
		<input type="text" name="type" placeholder="Type" /><br />
		upload bill<input type="file" name="car_bill"  placeholder="upload Bill" /><br />
		<div id="upload"><button class="btn">Upload</button></div>
	</form>
</div>
</body>
<script>
	/////code for updating and loading table
	function load_table()
	{
		$.post("load_table_vehicle.php",{userID:"<?php echo $userID?>",familyID:"<?php echo $familyID?>"},function(data){
			$("#show_service tbody").html(data);
			
			})
	}
	function update_table()
	{
		var formData = new FormData($("#update_service form")[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		$.ajax({
			url: "update_table_vehicle.php",
			type: 'POST',
			data:formData,
			async: false,
			success: function (data) {
				$("#hello").html(data);
				load_table();
			},
			cache: false,
			contentType: false,
			processData: false
		});	
	}
	$("#click").click(function(){
			$("#update_service").slideDown(1000);
			$('body').on("keypress keydown keyup",function(e){
					if(e.which==27)
					$("#update_service").slideUp(000);
				});
		});
		
	$("#upload").click(function(){
			$("#update_service").hide(2000);
			update_table();
		});
	///end-------------
load_table();
</script>

</html>