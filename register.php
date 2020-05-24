<?php
require "config.php";
require "errors.php";
//Initialising variables
$reg_fname="";
$reg_lname="";
$reg_emailId="";
$reg_uname="";
$reg_password1="";
$reg_password2="";
$reg_date="";

if (isset($_POST['reg_btn']))
{
 
 //Validating user input
 $reg_fname=strip_tags($_POST['reg_fname']);
 $reg_fname=str_replace(" ", "", $reg_fname);
 $reg_fname=ucfirst(strtolower($reg_fname));
 $_SESSION['fname']=$reg_fname;
 if(strlen($reg_fname)<1 || strlen($reg_fname)>25)
 {
 	array_push($error_array,"First name should be 1 to 25 characters long");
 }

 $reg_lname=strip_tags($_POST['reg_lname']);
 $reg_lname=str_replace(" ", "", $reg_lname);
 $reg_lname=ucfirst(strtolower($reg_lname));
 $_SESSION['lname']=$reg_lname;
 if(strlen($reg_lname)<1 || strlen($reg_lname)>25)
 {
 	array_push($error_array,"Last name should be 1 to 25 characters long");
 }

 $reg_emailId=strip_tags($_POST['reg_emailId']);
 $_SESSION['emailId']=$reg_emailId;

 $reg_uname=strip_tags($_POST['reg_uname']);
 $_SESSION['uname']=$reg_uname;

 $reg_password1=strip_tags($_POST['reg_password1']);

 $reg_password2=strip_tags($_POST['reg_password2']);

 $reg_date=date("d-m-Y"); 

//Checking if an account already exists with the entered email id
$reg_emailId = filter_var($reg_emailId, FILTER_VALIDATE_EMAIL);
$e_check=mysqli_query($conn,"SELECT email FROM users WHERE email='$reg_emailId' ");
$num_rows=mysqli_num_rows($e_check);

if (filter_var($reg_emailId, FILTER_VALIDATE_EMAIL))
{
	$reg_emailId = filter_var($reg_emailId, FILTER_VALIDATE_EMAIL);
	$e_check=mysqli_query($conn,"SELECT email FROM users WHERE email='$reg_emailId' ");
	if ($num_rows>0)
	{
		array_push($error_array,"Email already exists");
	}
}
else
{
	array_push($error_array,"Invalid Email format");
}

$u_check=mysqli_query($conn,"SELECT * FROM users WHERE username='$reg_uname'");
$num_rows=mysqli_num_rows($u_check);
if($num_rows>0){
	array_push($error_array,"Username already exists");
}

if ($reg_password1!=$reg_password2)
{
	array_push($error_array,"Passwords don't match");
}
else
{
	if(preg_match('/[^A-Za-z0-9]/', $reg_password1)) {
	array_push($error_array, "Your password can only contain english characters or numbers<br>");}

}
if(empty($error_array)) {
		$reg_password1 = md5($reg_password1);
		/*$username = strtolower($reg_fname . "_" . $reg_lname);		
		Profile picture assignment
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";*/


		$query = mysqli_query($conn, "INSERT INTO users VALUES ('','$reg_fname', '$reg_lname', '$reg_uname', '$reg_emailId', '$reg_password1', '$reg_date', '', '0', '0', 'no', ',', ',')");


		header("Location: hobbies.php");
		exit();
	}

}
?>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" href="css/register_style.css">
</head>
<body>
<div class="form_bg">
<br><h2>Registration</h2><br>
<form action="register.php" method="post">
	<label for="reg_fname">First name</label><br>
    <input type="text" id="reg_fname" name="reg_fname" value="<?php 
    if (isset($_SESSION['reg_fname']))
    {
    	echo $_SESSION['reg_fname'];
    }
    ?>" required><br>
    <div class="error">
    <?php 
    if(in_array("First name should be 1 to 25 characters long",$error_array)){echo "First name should be 1 to 25 characters long<br>";}
    ?></div><br>

    <label for="reg_lname">Last name</label><br>
    <input type="text" id="reg_lname" name="reg_lname"
    value="<?php 
    if (isset($_SESSION['reg_lname']))
    {
    	echo $_SESSION['reg_lname'];
    }
    ?>" required><br>
    <div class="error">
    <?php 
    if(in_array("Last name should be 1 to 25 characters long",$error_array)){echo "Last name should be 1 to 25 characters long  <br>";}
    ?></div><br>

    <label for="reg_emailId">Email ID</label><br>
    <input type="email" id="reg_emailId" name="reg_emailId" value="<?php 
    if (isset($_SESSION['reg_emailId']))
    {
    	echo $_SESSION['reg_emailId'];
    }
    ?>"  required><br>
    <div class="error">
    <?php 
    if(in_array("Email already exists",$error_array)){echo "Email already exists<br>";}
    if(in_array("Invalid Email format",$error_array)){echo "Invalid Email format<br>";}
    ?></div><br>

    <label for="reg_uname">User name</label><br>
    <input type="text" id="reg_uname" name="reg_uname" value="<?php 
    if (isset($_SESSION['reg_uname']))
    {
    	echo $_SESSION['reg_uname'];
    }
    ?>" required><br>
    <div class="error">
    <?php 
    if(in_array("Username already exists",$error_array)){echo "Username already exists<br>";}
    ?></div>
    <br>

    <label for="reg_password1">Password</label><br>
    <input type="password" id="reg_password1" name="reg_password1" required><br>
    <div class="error">
    <?php 
    if(in_array("Passwords don't match",$error_array)){echo "Passwords don't match<br>";}
    if(in_array("Your password can only contain english characters or numbers",$error_array)){echo "Your password can only contain english characters or numbers<br>";}
    ?></div><br>

    <label for="reg_password2">Confirm Password</label><br>
    <input type="password" id="reg_password2" name="reg_password2" required><br><br><br>

    <input type="submit" id="reg_btn" name="reg_btn" value="Sign up"><br><br>

    <div class="end">Already a member? <a href="login.php">Login</a></div>
</form>
</div>
</body>
</html>