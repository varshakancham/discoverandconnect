<?php
require "config.php";
require "errors.php";
$log_emailId="";
$log_password="";

if(isset($_POST["log_btn"]))
{
	$log_emailId=filter_var($_POST['log_emailId'], FILTER_SANITIZE_EMAIL);
	$_SESSION['log_emailId']=$log_emailId;
	$log_password=strip_tags($_POST['log_password']);
	$log_password=md5($log_password);
	$query=mysqli_query($conn,"SELECT * FROM users WHERE email='$log_emailId' AND password='$log_password'");
	$num_rows=mysqli_num_rows($query);
	if($num_rows==1)
	{
		$row=mysqli_fetch_array($query);
		$username=$row['username'];
		$user_closed=$row['user_closed'];
		if($user_closed=="yes")
		{
			$query_user_closed=mysqli_query($conn, "UPDATE users SET user_closed='no' WHERE email='$log_emailId'");
		}
		header("Location: index.php");
		exit();
	}
	else
	{
		$query_email=mysqli_query($conn, "SELECT * FROM users WHERE email='$log_emailId'");
		$num_rows_email=mysqli_num_rows($query_email);
		if($num_rows_email==0)
		{
			array_push($error_array, "Email not found");
		}
		else
		{
			array_push($error_array, "Incorrect password");
		}

	}
}

?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="register_style.css">
</head>
<body>
<div class="form_bg">
<h2>Login</h2>
<form action="login.php" method="post">
	<label for="log_emailId">Email ID</label><br>
    <input type="email" id="log_emailId" name="log_emailId" required><br>
    <div class="error">
    <?php 
    if(in_array("Email not found",$error_array)){echo "Email not found<br>";}
    ?></div><br>

    <label for="log_password">Password</label><br>
    <input type="password" id="log_password" name="log_password" required><br>
    <div class="error">
    <?php 
    if(in_array("Incorrect password",$error_array)){echo "Incorrect password<br>";}
    ?></div><br>

    <input type="submit" id="log_btn" name="log_btn" value="Login"><br><br>

    <div class="end"><a href="forgotpw.php">Forgot Password?</a><br><br>
    	Not a member? <a href="register.php">Register</a></div>
   </form>
   </div>
</body>
</html>