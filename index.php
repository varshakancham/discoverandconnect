<?php
include("NavBar.php");
?>
<link rel="stylesheet" href="style_index.css">
 <div class = "user_panel">
 <ul class = "user_panel_row">
 <li>
 <a href="#" class=""><img src="images/Userpanelimg.png" class = "user_panel_image"></a>
 </li>
 <li style="color:white; font-size:30px;">
  <?php echo $_SESSION['userfirstname']; ?> 
  </li>
</ul>
 <div style="width: 90%;background-color:#21e6c1;height:1px;align-self:center;margin:5px"></div>
  <ul class="user_panel_row">
         <li class="up1"> No of Likes :</li>
         <li class="up2"> <?php echo $_SESSION['userlike']; ?></li>
</ul>
<ul class="user_panel_row">
         <li class="up1"> No of Posts :</li>
         <li class="up2"> <?php echo $_SESSION['userpost']; ?>
</li>
</ul>


           
 </div>
