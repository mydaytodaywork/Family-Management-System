<script>

 //code for searching people
$("#search").focusin(function(){
		$(this).on("keypress keydown keyup click dblclick focus ",function(){
				var val=$("#search").val();
				$.post('search_people.php',{userID:"<?php echo $userID ;?>",text:val,
				familyID:"<?php echo $_SESSION["familyID"];?>"},
					function(data){
							$("#search_result").html(data);
							$("#search_result").show();
						}
				);
				
			});
	});

$("#search").blur(function(){
		$("body").click(function(){$("#search_result").hide()});
		
		
 	});
	
$("#new_message").hide();
//script 2
function display_name()
	{
		$.post('get_details.php',{otherID:"<?php echo $otherID?>",familyID:"<?php echo $_SESSION["familyID"]?>"},function(data){$("#top span").html(data);});	
	};
	
//message script
	var get="<?php echo $otherID ?>";
	var other=get;
	
	$("div.message").focusin(function(){
			$("#mes").attr('src',"images/white.png");
			$("#new_message").show();
			$.post("display_message.php",{userID:"<?php echo $userID;?>",
				familyID:"<?php echo $familyID; ?>"
			},function(data){
					$("#new_message").html(data);
					$(".messx").click(function(){
						
						other=$(this).data("person");
				$("#messagebox").show(1000);
				$.post('load_message.php',{
				userID:"<?php echo $userID ?>",
				otherID:other,
				familyID:"<?php echo $_SESSION["familyID"]?>"
			},function(data){
				display_name();
					$("#messages").html(data);
					$("#messages").show(2000);
					$("#new_message").hide();
					$("#mes").attr('src',"images/black.png");
				
				});
				
			
		});	
				
				});
		});
	//display name
	function display_name()
	{
		$.post('get_details.php',{otherID:window.other,familyID:"<?php echo $_SESSION["familyID"]?>"},function(data){$("#top span").html(data);});	
	};
		
	//message loading
		
	
	
		
	$("#main,#left,#right,#wall").click(function(){$("#new_message").hide();
	$("#mes").attr('src',"images/black.png");
	//alert();
	});
	
	//message sending form #enter textarea
	$("#enter textarea").keypress(function(e) {
    if(e.which == 13) {
       var val=$("#enter textarea").val();
	   if(val=="")
	   {
			return false;   
		}
		else
		{
			$("#enter textarea").val("");
			//posting meassage into message database
			$.post('post_message.php',{message:val,
			sender:"<?php echo $userID ?>",
			receiver:window.other,
			familyID:"<?php echo $_SESSION["familyID"]?>"
			},function(data1){
					$.post('load_message.php',{
			userID:"<?php echo $userID ?>",
			otherID:window.other,
			familyID:"<?php echo $_SESSION["familyID"]?>"
			},function(data){
					$("#messages").html(data);
					$("#messagebox").animate({scrollTop:$("#messagebox").get(0).scrollHeight});
				});
				});
		}
    }
	});

//code for searching people
$("#search").focusin(function(){
		$(this).on("keypress keydown keyup click dblclick focus ",function(){
				var val=$("#search").val();
				$.post('search_people.php',{userID:"<?php echo $userID ;?>",text:val,
				familyID:"<?php echo $_SESSION["familyID"];?>"},
					function(data){
							$("#search_result").html(data);
							$("#search_result").show();
						}
				);
				
			});
	});
$("#search").blur(function(){
		$("body").click(function(){$("#search_result").hide()});
		
		
 	});
	
	
//message button for otherprofile page

$("#sendmessage").focusin(function(){
			$("#messagebox").show(1000);
			$.post('load_message.php',{
			userID:"<?php echo $userID ?>",
			otherID:window.other,
			familyID:"<?php echo $_SESSION["familyID"]?>"
			},function(data){
					$("#messages").html(data);
					$("#messages").show(2000);
				});
		});
	
		
	$("#close").click(function(){$("#messagebox").hide(1000);});
	
	
	
	//loading new messages
	function load_new()
	{
		
		if($("#messagebox").css("display") !='none')
		{
			
			$.post('load_new_message.php',{
			userID:"<?php echo $userID ?>",
			otherID:window.other,
			familyID:"<?php echo $_SESSION["familyID"];?>"
			},function(data){
				if(data=="no")
				{
					return
				}
			$("#messagebox").animate({scrollTop:$("#messagebox").get(0).scrollHeight},100);
					$("#messages").html($("#messages").html()+data);
					$(".new_message").fadeIn(2600);
				});
		}
		setTimeout(load_new,2000);
	}
	load_new();
	$("#sendmessage").focusin(function(){
			other=get;
			$("#messagebox").show(1000);
			$.post('load_message.php',{
			userID:"<?php echo $userID ?>",
			otherID:"<?php echo $otherID?>",
			familyID:"<?php echo $_SESSION["familyID"]?>"
			},function(data){
					$("#messages").html(data);
					$("#messages").show(2000);
					display_name()
				});
		});
</script>