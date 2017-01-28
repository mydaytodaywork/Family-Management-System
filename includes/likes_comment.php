<script>
//script 2
//for comments and likes
//function for loading comments

//hover like effects
function attach()
{
	
	$("div.hover_like_people").hover(function(){
		$(this).siblings("div.like_people_list1").show();
		
		},
		
		function(){
		$(this).siblings("div.like_people_list1").hide();
		}
	
	);	
}

function load_comment(postid,ob)
{
	$.post("load_comment.php",{
		postID:postid,
		userID:"<?php echo $userID?>",
		familyID:"<?php echo $_SESSION["familyID"]?>"
		},function(data){
			//alert(data);
			ob.html(data);
			attach()
			attach_comment();
			
			}).complete(function(){attach_comment();});
	
}

function load_total_likes(selector)
{
	var postid=selector.parent().data("postid");
		$.post("total_likes.php",
		{
			postID:postid,
			userID:"<?php echo $userID?>",
			familyID:"<?php echo $_SESSION["familyID"]?>"
		},function(data){
				selector.html(data);
				attach();
				attach_comment();
			})
			
}

$("div.comm").click(function(){
	$(this).parent().siblings("div.comments").toggle();
	var postID=$(this).data("postid");
	var x=$(this).parent().siblings("div.comments").find("div.comment_list");
	load_total_likes($(this).parent().siblings("div.comments").find("div.like_comment"));
	load_comment(postID,x)
	attach();
	attach_comment();
		
	});
	
$("div.write_comment input").on("keypress keydown keyup",function(e){
		var val=$(this).val();
		if(val!="" && e.which == 13)
		{
			$(this).val("");
			var ob=$(this).parent().siblings("div.comment_list");
			var postid=$(this).parent().parent().data("postid");
			$.post("post_comment.php",{
				postID:postid,
				userID:"<?php echo $userID?>",
				familyID:"<?php echo $_SESSION["familyID"]?>",
				content:val
				},function(data){
					
					load_comment(postid,ob)
					attach_comment();
					
					})
		}
	
	
	});
	
//function for making likes
$("div.likes").click(function(){
		var postid=$(this).data("postid");
		var x=$(this);
		$.post("post_likes.php",
		{
			postID:postid,
			userID:"<?php echo $userID?>",
			familyID:"<?php echo $_SESSION["familyID"]?>"
		},function(data){
				if(data=="liked")
				{
					x.find("img").attr("src","images/blue_like.png");
					x.css("color","#5e82fa");
					
				}
				else{
					x.find("img").attr("src","images/grey_like.png");
					x.css("color","#5f6167");	
				}
				
				load_total_likes(x.parent().siblings("div.comments").find("div.like_comment"));
				
			})
	
	});
	
$("div.likes").each(function(){
		var postid=$(this).data("postid");
		var x=$(this);
		$.post("load_likes_post.php",
		{
			postID:postid,
			userID:"<?php echo $userID?>",
			familyID:"<?php echo $_SESSION["familyID"]?>"
		},function(data){
				if(data=="liked")
				{
					x.find("img").attr("src","images/blue_like.png");
					x.css("color","#5e82fa");
				}
				else{
					x.find("img").attr("src","images/grey_like.png");
					x.css("color","#5f6167");	
				}
			})
	
	});
//hover like effect
function attach_comment()
{
	$("div.comment_like").click(function(){
			//alert('hello');
			var parent=$(this).parent();
			//alert(parent.data("postid"));
			$.post("load_like_comment.php",
			{
				userID:"<?php echo $userID;?>",
				familyID:"<?php echo $_SESSION["familyID"]?>",
				postID:parent.data("postid"),
				commentID:parent.data("commentid"),
				time:parent.data('time')
			},function(data){
				parent.html(data);
				attach_comment();
				})
		})
		
			
}	



</script>