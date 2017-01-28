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
	#info{
			margin-bottom:10px;
			color:#140173;
			font-weight:bold;
		}

	#info div{
			display:inline-block;
			margin-right:20px;
			
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
				<th>Company Name</th>
				<th>Insurance Number</th>
				<th>Duration</th>
				<th>Annual Deposite</th>
				<th>Plan Type</th>
				<th>Papers</th>
				<th>Details</th>
			</tr>
		</thead>
		<tbody>
			
			
		</tbody>
	</table>
</div>
<?php 
if(!isset($_GET['others']))
{
	echo "<div id='click' ><button class='btn' style='width:auto'>Add Account</button></div>";	
}

?>
</div>
<div class="table_content2">
<div id="info">
	<span>Insurance Number: </span><div class="account_no"></div>
</div>
	<div id="show_service2">
	<table>
		<thead>
			<tr>
				<th>Ammount</th>
				<th>Date</th>
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
	echo "<div class='withd' ><button class='btn' style='width:auto'>Add payment</button></div>";	
}

?>
</div>


<div id="update_service" >
	<form method="post" enctype="multipart/form-data">
		<input type="text" name="company_name" placeholder="Company Name" />
		<input type="text" name="insurance_no" placeholder="Insurance Number" />
		<input type="text" name="plan_type" placeholder="Plan Type" />
		<input type="text" name="annual" placeholder="Annual Deposite" />
		<input type="text" name="years" placeholder="Years" />
		<input type="file" name="papers"  />
		<div id="upload"><button class="btn">Upload</button></div>
	</form>
</div>

<div id="update_service2" >
	<div class="theader">Withdrawl</div>
	<form method="post" enctype="multipart/form-data">
		<input type="date" name="date" placeholder="Date" />
		<input type="text" name="ammount" placeholder="Ammount" /><br />
		upload Bill<input type="file" name="bill" placeholder="Bill" />
		<div id="upload2"><input type="submit" class="btn"  value="Upload"></div>
	</form>
</div>



</body>
<script>
	insid="dd";
	function load_table_account()
	{
		$.post("load_table_paid.php",{userID:"<?php echo $userID?>",familyID:"<?php echo $familyID?>",insurance_ID:window.insid},function(data){
			$("#show_service2 tbody").html(data);
			$("div.table_content2").show();
				});
			
	}
	
	function update_table2()
	{
		var formData = new FormData($("#update_service2 form")[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		formData.append("insurance_ID",window.insid);
		$.ajax({
			url: "update_table_paid.php",
			type: 'POST',
			data:formData,	
			contentType: false,
    		processData: false,
			success: function (data) {
				$("#update_service2").hide();
				 load_table_account()
			}
			
		});
	}
	/////code for updating and loading table
	function load_table()
	{
		$.post("load_table_insurance.php",{userID:"<?php echo $userID?>",familyID:"<?php echo $familyID?>"},function(data){
			$("#show_service tbody").html(data);
			$("td.account").click(function(){
				window.insid=$(this).parent().data("insid");
				var ins_no=$(this).parent().data("ins_no");
				$("div.table_content2").find("#info").find("div.account_no").text(ins_no);
				 load_table_account();
				//$("div.table_content2").show();
				 
				
				});
			})
	}
	function update_table()
	{
		var formData = new FormData($("#update_service form")[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		$.ajax({
			url: "update_table_insurance.php",
			type: 'POST',
			data:formData,
			async: false,
			success: function (data) {
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
					$("#update_service,#update_service2").slideUp(000);
				});
		});
		
	$("#upload").click(function(){
			$("#update_service").hide(2000);
			update_table();
		});
	////end-------------
load_table();


</script>

<script>
	$("div.withd").click(function(){
			$("#update_service2").show(500);
			$('body').on("keypress keydown keyup",function(e){
					if(e.which==27)
					$("#update_service,#update_service2").slideUp(000);
				});
			$("#update_service2 form").submit(function(event){
				event.preventDefault();
				 update_table2();	
				
				});
			
		});
	
	
</script>

</html>