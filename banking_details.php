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
			<tr style=>
				<th>Bank Name</th>
				<th>Account Number</th>
				<th>Saving Account</th>
				<th>Fixed Account</th>
				<th>Current Account</th>
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
	<span>Account Number: </span><div class="account_no"></div>
	<span>Account Type: </span><div class="type"></div>
</div>
	<div id="show_service2">
	<table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Balance Deposited</th>
				<th>Balance Withdrawl</th>
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
	echo "<div class='withd' data-type='Deposit'><button class='btn' style='width:auto'>Add Deposit</button></div>";	
}

?>
<?php 
if(!isset($_GET['others']))
{
	echo "<div class='withd' data-type='Withdrawl'><button class='btn' style='width:auto'>Add Withdraw</button></div>";	
}

?>

</div>


<div id="update_service" >
	<form method="post" enctype="multipart/form-data">
		<input type="text" name="bank_name" placeholder="Bank Name" />
		<input type="text" name="account_no" placeholder="Account Number" />
		<div id="upload"><button class="btn">Upload</button></div>
	</form>
</div>

<div id="update_service2" >
	<div class="theader">Withdrawl</div>
	<form method="post" enctype="multipart/form-data">
		<input type="date" name="date" placeholder="Bank Name" />
		<input type="text" name="ammount" placeholder="Ammount" /><br />
		upload Bill<input type="file" name="bill" placeholder="Bill" />
		<div id="upload2"><input type="submit" class="btn"  value="Upload"></div>
	</form>
</div>



</body>
<script>
	accountid="dd";
	accounttype="s";
	function load_table_account()
	{
		$.post("load_table_account.php",{userID:"<?php echo $userID?>",familyID:"<?php echo $familyID?>",accountID:window.accountid,type:window.accounttype},function(data){
			$("#show_service2 tbody").html(data);
			$("td.account").click(function(){
				window.accountid=$(this).parent().data("accountid");
				window.accounttype=$(this).data("type");
				var account_no=$(this).parent().data("account_no");
				var type=$(this).data("type");
				$("div.table_content2").find("#info").find("div.account_no").text(account_no);
				$("div.table_content2").find("#info").find("div.type").text(type);
				$("div.table_content2").show();
				
				});
			})
	}
	function update_table2(action)
	{
		var formData = new FormData($("#update_service2 form")[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		formData.append("account_ID",window.accountid);
		formData.append("type",window.accounttype);
		formData.append("action",action);
		$.ajax({
			url: "update_table_account.php",
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
		$.post("load_table_banking.php",{userID:"<?php echo $userID?>",familyID:"<?php echo $familyID?>"},function(data){
			$("#show_service tbody").html(data);
			$("td.account").click(function(){
				window.accountid=$(this).parent().data("accountid");
				window.accounttype=$(this).data("type");
				$("div.table_content2").show();
				 load_table_account()
				
				});
			})
	}
	function update_table()
	{
		var formData = new FormData($("#update_service form")[0]);
		formData.append("userID","<?php echo $userID;?>");
		formData.append("familyID","<?php echo $familyID;?>");
		$.ajax({
			url: "update_table_banking.php",
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
					$("#update_service,#update_service2").slideUp(000);
				});
		});
		
	$("#upload").click(function(){
			$("#update_service").hide(2000);
			update_table();
		});
	///end-------------
load_table();


</script>

<script>
	$("div.withd").click(function(){
			var action=$(this).data("type")
			$("div.theader").text(action);
			$("#update_service2").data("action",action);
			$("#update_service2").show(500);
			$('body').on("keypress keydown keyup",function(e){
					if(e.which==27)
					$("#update_service,#update_service2").slideUp(000);
				});
			$("#update_service2 form").submit(function(event){
				event.preventDefault();
				var accountid1=window.accountid;
				 update_table2(action);	
				
				});
			
		});
	
	
</script>

</html>