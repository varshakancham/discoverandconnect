<?php
require "config.php";
//require "errors.php";

include("NavBar.php");

$username = $_SESSION['username'];

include("includes\classes\User.php");
include("includes\classes\Post.php");

if(isset($_POST['post'])){
      
      $post = new Post($conn,$username);
      $post->submitPost($_POST['post_text'],'none');
      header("Location: index.php");
}



if(!isset($_SESSION['username']))
{
      header("Location: login.php");
      exit();
}


?>
<link rel="stylesheet" href="style_index.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<div>
      <div class = "user_panel">
            <ul class = "user_panel_row">
            <li>
            <a href="<?php echo $username; ?>" class=""><img src="images/Userpanelimg.png" class = "user_panel_image"></a>
            </li>
            <li style="color:white; font-size:30px;">
            <a href="<?php echo $username; ?>" class="">
            <?php echo $_SESSION['first_name']; ?> 
            </a>
            </li>
            </ul>
                  <div style="width: 90%;background-color:#21e6c1;height:1px;align-self:center;margin:5px"></div>
            <ul class="user_panel_row">
                  <li class="up1"> No of Likes :</li>
                  <li class="up2"> <?php echo $_SESSION['num_likes']; ?></li>
            </ul>
            <ul class="user_panel_row">
                  <li class="up1"> No of Posts :</li>
                  <li class="up2"> <?php echo $_SESSION['num_posts']; ?>
                  </li>
            </ul>       
      </div>



  
      <div style="width:72.5%;float:right;">
            <div class = "user_post" >
            <form class="post_form" action="index.php" method="POST">
            <div style="width:100%;">
                  <textarea name="post_text" id="post_text" placeholder="      Share your thoughts!"></textarea>
            </div>
            <div align="right" style="width:100%;">
            <input type="submit" name="post" id="post_button" value ="POST">
            </div>
            
            </form>
            </div>
      </div>
      
</div>




 
 <div style=" width:72.5%;float:right">
      <div class="posts_area"></div>
      <div align='center' style='padding:10px;'>
            <img class ="loading" src='assets\images\Loading.gif' style='width:35;' >
      </div>
 </div>

 <?php 
      $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

            $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
            $num_hobbies = (substr_count($user_array['hobbies'], ",")) +1;
      ?>
      <div class = "user_panel" style="float:left;" align ="center">
      <ul class="up1">Friends</ul>
      <div style="width: 90%;background-color:#21e6c1;height:1px;align-self:center;margin:5px"></div>
      
            <?php 
            $friend=explode(",",$user_array['friend_array']);
            for($i =1 ;$i<6 && $i<= $num_friends;$i++)
            {
                  echo nl2br("<ul style = 'color:white;'>".$friend[$i]."</ul>");
            }
            ?>
      <div style="width: 90%;background-color:#21e6c1;height:1px;align-self:center;margin:5px"></div>
      <a href="recommend.php">Find more Friends</a>
      </div>

 
<script>
var userLoggedIn ='<?php echo $username; ?>';

$(document).ready(function(){
      $('#loading').show();

      $.ajax({
            url: "includes/handlers/ajax_load_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
            cache:false,

            success: function(data){
                  
                  $('#loading').hide();
                  $('.posts_area').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                  alert("Error: " + errorThrown);
      }
      });
      
      $(window).scroll(function(){
            var height = $('.posts_area').height();
            var scroll_top = $(this).scrollTop();
            var page = $('.posts_area').find('.nextPage').val();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();
            
            if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						
                                    
						$('#loading').hide();
						$('.posts_area').append(response);
					}

                        
				});

			}
            return false;
      });

});
</script>


