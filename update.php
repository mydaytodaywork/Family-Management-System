<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="login.css"/>
</head>

<body>
	<div id="header" style="height:50px;">
		<h1 style="float:left;">Family portal</h1>
        <div style="margin-left: 400px; float:right; position:absolute; margin-top:16px; clear:both;">
        	<input type="search" size="20" style="width:300px; height:20px;" placeholder="search"  name="searchtext"/>
        </div>
        <div style="margin-left: 720px;  float:right; position:absolute; margin-top:10px; clear:both;">
			<input type="submit"  name="submit" value="Search" id="button" / >
		</div>
        
         <div style="margin-left: 1000px; float:right; position:absolute; margin-top:16px; clear:both;">
        	<a href="home.php" style="text-decoration:none; color:#FFF">Home</a>
        </div>
        <div style="margin-left: 1080px; float:right; position:absolute; margin-top:16px; clear:both;">
        	<a href="profile.php" style="text-decoration:none; color:#FFF">Profile</a>
        </div>
        <div style="margin-left: 1160px; float:right; position:absolute; margin-top:16px; clear:both;">
        	<a href="logout.php" style="text-decoration:none; color:#FFF">Logout</a>
        </div>
	</div>
    //updating informatiton
    <p style="margin-top:80px; color:#000; margin-left:530px; font-size:30px; text-decoration:underline; text-shadow:2px 2px #999999"><b>UPDATE INFORMATION<b></p>
    
    <div style=" margin:15px; margin-top:30px; float:left; width:410px; height:auto; background-color:#FFF; margin-left:30px; border-radius:15px;">
    <form>
    	<fieldset style="margin:15px;">
        	<legend><p style="font-size:25px;">Personal Details</p></legend>
            <input type="text" style=" margin-top:20px;" class="update" name="username" placeholder="USERNAME">
            <input type="text" class="update" name="firstname" placeholder="FIRSTNAME">
            <input type="text" class="update" name="lastname" placeholder="LASTNAME">
            <input type="text" class="update" name="password" placeholder="PASSWORD">
            
            <input type="text" class="update" name="dob" placeholder="DATE OF BIRTH">
            
            <input type="text" class="update" name="address" placeholder="ADDRESS">
            
            <input type="text" class="update" name="phone" placeholder="PHONE">
            
            <input type="text" class="update" name="email" placeholder="EMAIL">
			<input type="text" class="update" name="income" placeholder="INCOME">
            <input type="text" class="update" name="relation" placeholder="RELATION WITH HEAD" style="margin-bottom:20px;">
            <input type="submit" value="UPDATE" class="updsub" name="updatepersonal"/>
        </fieldset>
     </form>   
    </div>
    
     <div style=" margin:15px; margin-top:30px; float:left; width:410px; height:auto; background-color:#FFF; border-radius:15px;">
     	 <form>
    	<fieldset style="margin:15px;">
        	<legend><p style="font-size:25px;"> ABOUT CAR </p></legend>
            <input type="text" style=" margin-top:20px;" class="update" name="carname" placeholder="CARNAME">
            
            <input type="text" class="update" name="carnumber" placeholder="CAR NUMBER">
            
            <input type="text" class="update" name="insuranceNo" placeholder="CAR INSURANCE NUMBER"><br/>
            <p style="margin-left:10px; margin-top:20px;">LAST PREMIUM:</p>
            <input type="date" class="update" name="last_premium" placeholder="LAST PREMIUM" style="margin-top:1px; margin-bottom:20px;"><br/>
			 <p style="margin-left:10px;">NEXT PREMIUM:</p>
            <input type="date" class="update" name="next_premium" placeholder="NEXT PREMIUM" style="margin-top:1px; margin-bottom:20px;" >
            <input type="submit" value="UPDATE" class="updsub" name="updatecar"/>
        </fieldset>
     </form> 
    
    </div>
    
     <div style=" margin:15px; margin-top:30px; float:left; width:410px; height:auto; background-color:#FFF; margin-right:10px; border-radius:15px;">
    	 <form>
    	<fieldset style="margin:15px;">
        	<legend><p style="font-size:25px;"> ABOUT BANK </p></legend>
            <input type="text" style=" margin-top:20px;" class="update" name="bankname" placeholder="BANKNAME">
            
            <input type="text" class="update" name="accountnumber" placeholder="ACCOUNT NUMBER">
           
            <input type="text" class="update" name="balance" placeholder="BALANCE" style="margin-bottom:20px;" >
            <input type="submit" value="UPDATE" class="updsub" name="updatebank"/>
        </fieldset>
     </form> 
    </div>
</body>
</html>