<?php
$conn=mysqli_connect("localhost","root","","discovernconnect");
if(mysqli_connect_errno())
{
	echo "Error Occurred".mysqli_connect_errno();
}
$reg_fname="";
$reg_lname="";
$reg_emailId="";
$reg_password1="";
$reg_password2="";
$reg_date="";
$error_array="";
if (isset($_POST['reg_btn']))
{
 
 $reg_fname=strip_tags($_POST['reg_fname']);
 $reg_fname=str_replace(" ", "", $reg_fname);
 $reg_fname=ucfirst(strtolower($reg_fname));
 
 $reg_lname=strip_tags($_POST['reg_lname']);
 $reg_lname=str_replace(" ", "", $reg_lname);
 $reg_lname=ucfirst(strtolower($reg_lname));

 $reg_emailId=strip_tags($_POST['reg_emailId']);

 $reg_password1=strip_tags($_POST['reg_password1']);

 $reg_password1=strip_tags($_POST['reg_password2']);

 $reg_date=date("d-m-Y"); 


if ($reg_password1!=$reg_password2)
{
	echo "Passwords don't match";
}
}
?>
<html>
<head>
	<title>Registration</title>
</head>
<body>
<form action="register.php" method="post">
	<label for="reg_fname">First name</label><br>
    <input type="text" id="reg_fname" name="reg_fname" required><br><br>
    <label for="reg_lname">Last name</label><br>
    <input type="text" id="reg_lname" name="reg_lname"><br><br>
    <label for="reg_emailId">Email ID</label><br>
    <input type="email" id="reg_emailId" name="reg_emailId" required><br><br>
    <label for="reg_password1">Password</label><br>
    <input type="password" id="reg_password1" name="reg_password1" required><br><br>
    <label for="reg_password2">Confirm Password</label><br>
    <input type="password" id="reg_password2" name="reg_password2" required><br><br>
    <input type="submit" id="reg_btn" name="reg_btn" value="Register"><br><br>
</form>
</body>
</html>