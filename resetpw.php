<?php
require "config.php";
require "errors.php";

$rp_emailId="";
$rp_code="";
$rp_code_db="";
$rp_password1="";
$rp_password2="";

if(isset($_POST['rp_btn'])){
	$rp_code=strip_tags($_POST['rp_code']);

	$rp_password1=strip_tags($_POST['rp_password1']);

	$rp_password2=strip_tags($_POST['rp_password2']);

	$rp_emailId=strip_tags($_POST['rp_emailId']);
    $rp_emailId = filter_var($rp_emailId, FILTER_VALIDATE_EMAIL);   
    if (filter_var($rp_emailId, FILTER_VALIDATE_EMAIL))
    {        
        $rpe_check=mysqli_query($conn,"SELECT email FROM users WHERE email='$rp_emailId' ");
        $rpenum_rows=mysqli_num_rows($rpe_check);
        if ($rpenum_rows!=1)
        {
            array_push($error_array,"Email not registered");
        }        
        else{
            $rp_check=mysqli_query($conn,"SELECT * FROM reset_password WHERE email='$rp_emailId' ");
            $rpnum_rows=mysqli_num_rows($rp_check);
	        if ($rpnum_rows!=1){
	            array_push($error_array,"Reset not requested");
	        }
	        else{
	        	$row=mysqli_fetch_array($rp_check);
	        	$rp_code_db=$row['code'];
	        }
        }
    }
    else{
        array_push($error_array,"Invalid Email format");
    }

    //Checking the validity of the code
    if($rp_code_db!=$rp_code){
		array_push($error_array, "Invalid Code");
	}

	//Checking if passwords match
	if ($rp_password1!=$rp_password2){
		array_push($error_array,"Passwords don't match");
	}
	//Checking if the password is valid
	else{
		if(preg_match('/[^A-Za-z0-9]/', $rp_password1)) {
		array_push($error_array, "Your password can only contain english characters or numbers<br>");}
	}

	if(empty($error_array)) {
		$rp_password1 = md5($rp_password1);
		$query=mysqli_query($conn, "UPDATE users SET password='$rp_password1' WHERE email='$rp_emailId' ");
		if($query){
	 		$query=mysqli_query($conn," DELETE FROM reset_password WHERE email='$rp_emailId'");
	 		array_push($error_array, "Password reset successfully");
	 	}
	 	else{
	 		array_push($error_array,"Something went wrong");
	 	}

	}

}


?>
<html>
<head>
	<link rel="stylesheet" href="css/register_style.css">
	<title>Reset Password</title>
</head>
<body>
	<div class="form_bg">
		<h2>Reset Password</h2>
		<form action="resetpw.php" method="post">
		<div class="error">
	    <?php 
	    if(in_array("Password reset successful",$error_array)){echo "Password reset successful<br>";}
	    if(in_array("Something went wrong",$error_array)){echo "Something went wrong. Try again.<br>";}
	    ?></div><br>

	    <label for="rp_emailId">Email ID</label><br>
	    <input type="email" id="rp_emailId" name="rp_emailId" required><br>
	    <div class="error">
	    <?php 
	    if(in_array("Email not registered",$error_array)){echo "Email not registered<br>";}
	    if(in_array("Invalid Email format",$error_array)){echo "Invalid Email format<br>";}
	    if(in_array("Reset not requested",$error_array)){echo "Reset not requested<br>";}
	    ?></div><br>

	    <label for="rp_code">Code</label><br>
	    <input type="text" id="rp_code" name="rp_code" required><br>
	    <div class="error">
	    <?php 
	    if(in_array("Invalid Code",$error_array)){echo "Invalid Code<br>";}
	    ?></div><br>

	    <label for="rp_password1">Password</label><br>
	    <input type="password" id="rp_password1" name="rp_password1" required><br>
	    <div class="error">
	    <?php 
	    if(in_array("Passwords don't match",$error_array)){echo "Passwords don't match<br>";}
	    if(in_array("Your password can only contain english characters or numbers",$error_array)){echo "Your password can only contain english characters or numbers<br>";}
	    ?></div><br>

	    <label for="rp_password2">Confirm Password</label><br>
	    <input type="password" id="rp_password2" name="rp_password2" required><br><br><br>

	    <input type="submit" id="rp_btn" name="rp_btn" value="Reset"><br><br>

	    <div class="end"><a href="login.php">Login</a><br>
    	</div>

		</form>
	</div>
</body>
</html>