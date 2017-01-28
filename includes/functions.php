<?php
	//function to create tables for new database family
	function create_tables($connection)
	{
		//family information table
		$query="CREATE TABLE family_info (";
		$query.="familyID VARCHAR(30) NOT NULL,";
		$query.="NoOfMembers INT(5) NOT NULL,";
		$query.="TotalIncome REAL NOT NULL);";
		mysqli_query($connection,$query);
		
		//family members including family heads
		$query="CREATE TABLE members (";
		$query.="firstname VARCHAR(30) NOT NULL,";
		$query.="lastname VARCHAR(30),";
		$query.="sex VARCHAR(10) NOT NULL,";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="email VARCHAR(50),";
		$query.="ishead TINYINT(1) NOT NULL);";
		mysqli_query($connection,$query);
		
		//userID and passwords
		$query="CREATE TABLE login (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="password VARCHAR(30) NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//income table
		$query="CREATE TABLE income (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="income REAL NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//detail
		$query="CREATE TABLE personalinfo (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="phone VARCHAR(11) DEFAULT NULL,";
		$query.="address VARCHAR(100) DEFAULT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//Sign up dates
		$query="CREATE TABLE signup_dates (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="date VARCHAR(50) NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//DATE OF BIRTHS
		$query="CREATE TABLE DOB (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="dob VARCHAR(50) NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//RELATION WITH HEAD
		$query="CREATE TABLE relation (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="rel VARCHAR(30) NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//POSTS
		$query="CREATE TABLE posts (";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="postID BIGINT(20) AUTO_INCREMENT PRIMARY KEY,";
		$query.="time VARCHAR(30) NOT NULL,";
		$query.="content TEXT NOT NULL,";
		$query.="files INT(2) NOT NULL,";
		$query.="address VARCHAR(30) NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//CARS
		$query="CREATE TABLE cars (";
		$query.="vehicle_id INT(20) AUTO_INCREMENT PRIMARY KEY ,";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="vehicle_name VARCHAR(50) NOT NULL,";
		$query.="vehicle_number VARCHAR(50) NOT NULL,";
		$query.="bill VARCHAR(100) DEFAULT 'none',";
		$query.="type VARCHAR(50) NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//car insurances
		$query="CREATE TABLE carInsurance (";
		$query.="carnumber VARCHAR(30) NOT NULL,";
		$query.="insuranceNo VARCHAR(30) NOT NULL,";
		$query.="userID VARCHAR(30) NOT NULL,";
		$query.="slip VARCHAR(100) DEFAULT 'none',";
		$query.="PRIMARY KEY (insuranceNo),";
		$query.="INDEX (carnumber));";
		mysqli_query($connection,$query);
		
		//life insurances
		$query="CREATE TABLE lifeinsurance (";
		$query.="insurance_ID bigint(20) AUTO_INCREMENT PRIMARY KEY, ";
		$query.="insurance_no VARCHAR(30) NOT NULL, ";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="companyname VARCHAR(20),";
		$query.="plan_type VARCHAR(20),";
		$query.="years REAL NOT NULL,";
		$query.="annual_deposit REAL,";
		$query.="papers VARCHAR(100) DEFAULT 'none');";
		mysqli_query($connection,$query);
		
		//insurance paid
		$query="CREATE TABLE insurance_action (";
		$query.="paid_ID bigint(20) AUTO_INCREMENT PRIMARY KEY, ";
		$query.="insurance_ID VARCHAR(30) NOT NULL, ";
		$query.="date VARCHAR(30) NOT NULL, ";
		$query.="ammount real NOT NULL, ";
		$query.="bill VARCHAR(100) DEFAULT 'none');";
		mysqli_query($connection,$query);
		
		//banking deatils
		$query="CREATE TABLE banking (";
		$query.="account_ID bigint(20) AUTO_INCREMENT PRIMARY KEY, ";
		$query.="account_no VARCHAR(30) NOT NULL, ";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="bankname VARCHAR(20)); ";
		mysqli_query($connection,$query);
		
		//account details
		$query="CREATE TABLE account_action (";
		$query.="action_ID bigint(20) AUTO_INCREMENT PRIMARY KEY, ";
		$query.="account_ID VARCHAR(30) NOT NULL, ";
		$query.="type VARCHAR(30) NOT NULL, ";
		$query.="date VARCHAR(30) NOT NULL, ";
		$query.="deposit real NOT NULL, ";
		$query.="withdraw real NOT NULL, ";
		$query.="bill VARCHAR(100) DEFAULT 'none');";
		mysqli_query($connection,$query);
		
		//service particulars
		$query="CREATE TABLE serviceparticulars (";
		$query.="id INT(20) AUTO_INCREMENT PRIMARY KEY ,";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="job VARCHAR(20),  ";
		$query.="jobtype varchar(20), ";
		$query.="sal integer(20), ";
		$query.="join_letter VARCHAR(100) DEFAULT 'none',";
		$query.="leave_letter VARCHAR(100) DEFAULT 'none',";
		$query.="startdate varchar(20) NOT NULL, ";
		$query.="enddate varchar(20) DEFAULT 'CURRENT',";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//leave details
		$query="CREATE TABLE leave_job (";
		$query.="jobID INT(20) NOT NULL,";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="job VARCHAR(20),  ";
		$query.="leavedate VARCHAR(20) NOT NULL, ";
		$query.="duration integer(20), ";
		$query.="form VARCHAR(100) DEFAULT 'none' ,";
		$query.="description VARCHAR(100), ";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//incometax
		$query="CREATE TABLE income_tax (";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="paiddate varchar(20) NOT NULL, ";
		$query.="taxamount integer(100), ";
		$query.="increason varchar(200), ";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//property
		$query="CREATE TABLE property (";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="datebought varchar(20) NOT NULL, ";
		$query.="amount integer(100), ";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//insurance
		$query="CREATE TABLE insurance (";
		$query.="userID VARCHAR(30) NOT NULL, ";
		$query.="insdate varchar(20) NOT NULL, ";
		$query.="insurancenumber integer(20) NOT NULL, ";
		$query.="amount integer(100), ";
		$query.="companyname varchar(100), ";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//Messages table
		$query="CREATE TABLE message (";
		$query.="sender VARCHAR(30) NOT NULL, ";
		$query.="receiver VARCHAR(30) NOT NULL ,";
		$query.="time INT(15) NOT NULL, ";
		$query.="text TEXT NOT NULL, ";
		$query.="seen TINYINT(1) NOT NULL DEFAULT 0) ";
		mysqli_query($connection,$query);
		
		//uploaded file table
		$query="CREATE TABLE uploads (";
		$query.="uploadID INT(20) AUTO_INCREMENT PRIMARY KEY ,";
		$query.="userID VARCHAR(50) NOT NULL,";
		$query.="address VARCHAR(200) NOT NULL,";
		$query.="name VARCHAR(200) NOT NULL)";
		mysqli_query($connection,$query);
		
		//profile pics
		//uploaded photos table
		$query="CREATE TABLE photos (";
		$query.="photoID INT(20) AUTO_INCREMENT PRIMARY KEY ,";
		$query.="userID VARCHAR(50) NOT NULL,";
		$query.="address VARCHAR(200) NOT NULL,";
		$query.="name VARCHAR(200) NOT NULL)";
		mysqli_query($connection,$query);
		
		
		//upload profile picture
		$query="CREATE TABLE profile_pics (";
		$query.="uploadID INT(20) NOT NULL,";
		$query.="userID VARCHAR(50) NOT NULL,";
		$query.="address VARCHAR(200) DEFAULT 'none')";
		mysqli_query($connection,$query);
		
		//comments table
		$query="CREATE TABLE comments (";
		$query.="commentID BIGINT(30)  AUTO_INCREMENT PRIMARY KEY,";
		$query.="userID VARCHAR(50) NOT NULL,";
		$query.="postID BIGINT(20),";
		$query.="time VARCHAR(30) NOT NULL,";
		$query.="content TEXT NOT NULL,";
		$query.="INDEX (userID));";
		mysqli_query($connection,$query);
		
		//likes for posts
		$query="CREATE TABLE like_posts (";
		$query.="postID BIGINT(20),";
		$query.="userID VARCHAR(50) NOT NULL)";
		mysqli_query($connection,$query);
		
		//likes for comments
		$query="CREATE TABLE like_comments (";
		$query.="commentID BIGINT(20),";
		$query.="userID VARCHAR(50) NOT NULL)";
		mysqli_query($connection,$query);
		
	}
	function getinfo($connection,$username)
	{
		$info=array();
		
		//family information table
		$query="select * from family_info";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['familyID']=$row[0];
				$info['NoOfMembers']=$row[1];
				$info['TotalIncome']=$row[2];
		}
		
		//members relation
		$query="select * from members where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['firstname']=$row[0];
				$info['lastname']=$row[1];
				$info['sex']=$row[2];
				$info['userID']=$row[3];
				$info['email']=$row[4];
				$info['ishead']=$row[5];
		}
		//login table
		$query="select * from login where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['password']=$row[1];
		}
		//income table
		$query="select * from income where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['income']=$row[1];
		}
		//personalinfo
		$query="select * from personalinfo where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['phone']=$row[1];
				$info['address']=$row[2];
		}
		
		//sign up date
		$query="select * from signup_dates where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['date']=$row[1];
		}
		
		//dob table
		$query="select * from DOB where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['dob']=$row[1];
		}
		//profile picture
		
		$query="SELECT * FROM profile_pics WHERE userID='{$username}'";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_assoc($result);
		$info['profile_address']=$row["address"];
		$info['profile_pic_id']=$row["uploadID"];
		//rel with head
		$query="select * from relation where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['rel']=$row[1];
		}
		
		//posts
		$query="select * from posts where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['time']=$row[1];
				$info['content']=$row[2];
		}
		
		//car
		$query="select * from cars where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['carname']=$row[1];
				$info['carnumber']=$row[2];
		}
		
		//car insurance
		$query="select * from carInsurance where userID='"."$username'";
		$chk=mysqli_query($connection,$query);
		while($row=mysqli_fetch_row($chk)){
				$info['insuranceNo']=$row[1];
				$info['last_premium']=$row[2];
				$info['next_premium']=$row[3];
		}
		
		
		
			return $info;
	}
	
	function check()
	{
		session_start();
	if(!isset($_POST['username']) and !isset($_SESSION['username']))
	{
		session_destroy();
		header('location:login.php?attempt=false1');	
	}
	if(isset($_POST['username']))
	{
		//checks login database
		include("includes/connection.php");
		$dbname="fs_".$_POST["familyID"];
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		$query="SELECT password FROM login WHERE userID="."'{$_POST['username']}'";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_row($result);
		//checks the password
		if($_POST['password']!=$row[0])
		{
			header('location:login.php?attempt=false2');	
		}
		else
		{
			
			$_SESSION=$_POST;	
		}
		
	}	
	}
	function check_session()
	{
		session_start();
		if(!isset($_SESSION['username']))
		{
			session_destroy();
			header('location:login.php?attempt=false1');	
		}	
	}
	
	function file_id_generator($connection)
	{
		$query="SELECT COUNT(*) FROM uploads;";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_row($result);
		return $row[0]+1;
	}
	
	function noOfLikes($id,$type,$connection)
	{
		
		if($type=="post")
		{
			$query="SELECT COUNT(*) FROM like_posts";
			$query.=" WHERE postID='{$id}';";
			$result=mysqli_query($connection,$query);
			$row=mysqli_fetch_row($result);
			return $row[0];
			
		}
		
		else
		{
			$query="SELECT COUNT(*) FROM like_comments";
			$query.=" WHERE commentID='{$id}';";	
			$result=mysqli_query($connection,$query);
			$row=mysqli_fetch_row($result);
			return $row[0];
		}
	}
	
	function noOfComments($postID,$connection)
	{
		$query="SELECT COUNT(*) FROM comments ";
		$query.="WHERE postID='{$postID}' ;";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_row($result);
		return $row[0];
			
	}

	function get_name($connection,$userID)
	{
		$query="select * from members where userID='{$userID}'";
		$chk=mysqli_query($connection,$query);
		$row=mysqli_fetch_row($chk);
		return $row[0]." ".$row[1];
					
	}
	
	function get_pic($connection,$userID)
	{
		$query="SELECT * FROM profile_pics WHERE userID='{$userID}'";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_assoc($result);	
		return $row["address"];
	}
	
	function gettime($ptime)
	{
		$etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
	}
?>