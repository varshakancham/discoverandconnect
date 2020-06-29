<?php
require "config.php";
require "errors.php";
if(isset($_POST['h_btn'])){
    $hobbies=$_POST['hobbies'];
    $hobbies=implode(",", $hobbies);
    $h_emailId=$_SESSION['emailId'];
    $query=mysqli_query($conn, "UPDATE users SET hobbies = '$hobbies' WHERE email='$h_emailId'");
    header("Location: login.php");
    exit();}
?>

<html>
<head>
	<title>Hobbies</title>
	<link rel="stylesheet" href="css/register_style.css">
</head>
<body>
<div class="form_bg">
<br><h2>Hobbies</h2>
<p id= "h_intro">Let us know more about you...<br>Pick your favourite hobbies, that will help us to suggest friends to you...</p>
<form action="hobbies.php" method="post">
	<input type="checkbox" id="reading" name="hobbies[]" value="reading">
    <label for="reading"> Reading</label><br><br>
    <input type="checkbox" id="dancing" name="hobbies[]" value="dancing">
    <label for="reading"> Dancing</label><br><br>
    <input type="checkbox" id="singing" name="hobbies[]" value="singing">
    <label for="reading"> Singing</label><br><br>
    <input type="checkbox" id="sports" name="hobbies[]" value="sports">
    <label for="reading"> Sports</label><br><br>
    <input type="checkbox" id="collecting" name="hobbies[]" value="collecting">
    <label for="reading"> Collecting</label><br><br>
    <input type="checkbox" id="painting" name="hobbies[]" value="painting">
    <label for="reading"> Painting</label><br><br>
    <input type="checkbox" id="traveling" name="hobbies[]" value="traveling">
    <label for="reading"> Traveling</label><br><br>
    <input type="checkbox" id="fashion" name="hobbies[]" value="fashion">
    <label for="reading"> Fashion</label><br><br>
    <input type="checkbox" id="cooking" name="hobbies[]" value="cooking">
    <label for="reading"> Cooking</label><br><br>
    <input type="checkbox" id="social_service" name="hobbies[]" value="social_service">
    <label for="reading"> Social Service</label><br><br><br>
    <input type="submit" id="h_btn" name="h_btn" value="Submit"><br><br>

</form>
</div>
</body>
</html>