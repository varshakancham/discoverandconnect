
<link rel="stylesheet" href="style_search.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">


<?php
require "config.php";
include("NavBar.php");

$username=$_SESSION['username'];


include("includes\classes\User.php");
include("includes\classes\Post.php");


$userid = $_SESSION['userid'];
$con = $conn;
$user_obj = new User($con, $username);

?>

  <?php
    
    $cmd = "python MLModule/recommend.py ".$userid;

    exec("$cmd", $output);
    ?>

    <div align = "center" style="border-radius: 10px;">
    <div class="main_column column" id="main_column">
      <div style =" color:white; font-size:20px;">
        Friends recommendation based on your Interests!
        <hr id='search_hr'>
      </div>
   <?php
    $i=0;
    while($i<5){
      $query=mysqli_query($conn,"SELECT * FROM users WHERE id = '$output[$i]'");
      $row=mysqli_fetch_array($query);

      $button = "";
			$mutual_friends = "";

			if($username != $row['username']) {
					
				//Generate button depending on friendship status 
				if($user_obj->isFriend($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='danger' value='Remove Friend'>";
				else if($user_obj->didReceiveRequest($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='warning' value='Respond to request'>";
				else if($user_obj->didSendRequest($row['username']))
					$button = "<input type='submit' class='default' value='Request Sent'>";
				else 
					$button = "<input type='submit' name='" . $row['username'] . "' class='success' value='Add Friend'>";

				$mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";


				//Button forms
				if(isset($_POST[$row['username']])) {

					if($user_obj->isFriend($row['username'])) {
						$user_obj->removeFriend($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else if($user_obj->didReceiveRequest($row['username'])) {
						header("Location: requests.php");
					}
					else if($user_obj->didSendRequest($row['username'])) {

					}
					else {
						$user_obj->sendRequest($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}

				}



			}

				$mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";

        if( $row['profile_pic']=='')
		{
			$row['profile_pic']="images\Userpanelimg.png";
		}

			echo "<div class='search_result' align='center' style='height:120px;'>
					
					<div align ='left' style='width:35%;'>

					<div class='result_profile_pic'>
						<a href='" . $row['username'] ."'><img src='". $row['profile_pic'] ."' style='height: 100px;'></a>
					</div>

						<a href='" . $row['username'] ."'> " . $row['first_name'] . " " . $row['last_name'] . "
						<p id='grey'> " . $row['username'] ."</p>
						</a>
						<br>
						" . $mutual_friends ."<br>
						<div class='searchPageFriendButtons'>
						<form action='' method='POST'>
							" . $button . "
							<br>
						</form>
					</div>
					</div>

				</div>
				<hr id='search_hr'>";



      $i++;
    }
    ?>
</div>
</div>
