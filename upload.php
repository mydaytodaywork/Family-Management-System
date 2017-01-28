<?php
include('includes/functions.php');
	if(count($_POST)>0)
	{
		$userID=$_POST['userID'];
		$dbname='fs_'.$_POST['familyID'];
		$post=$_POST['status'];
		$file=$_POST['file'];
		$files=0;
		$address='none';
		include("includes/connection.php");
		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		//checking if photo is attached
		if($file=="photo")
		{
			$name_photo=$_FILES['post_photo']['name'];
			$tmp_photo=$_FILES['post_photo']['tmp_name'];
			$id=file_id_generator($connection);
			$name_photo=$id."_".$name_photo;
			if(move_uploaded_file($tmp_photo,"uploads/".$name_photo))
			{
				$query="INSERT INTO uploads ";
				$query.="(userID,address,name) VALUES (";
				$query.="'{$userID}','uploads/{$name_photo}','{$name_photo}')";
				$result=mysqli_query($connection,$query);
				
				$query="INSERT INTO photos ";
				$query.="(userID,address,name) VALUES (";
				$query.="'{$userID}','uploads/{$name_photo}','{$name_photo}')";
				$result=mysqli_query($connection,$query);
				$files=1;
				$address="uploads/{$name_photo}";
				//die($address);
			}
			
			
	
		}
		//inserting into database
		//inserting into database
		$time=time();
		$query="INSERT INTO posts (userID,time,content,files,address) VALUES (";
		$query.="'{$userID}','{$time}',";
		$query.="'{$post}',{$files},'{$address}');";
		$result=mysqli_query($connection,$query);
		
	}

?>