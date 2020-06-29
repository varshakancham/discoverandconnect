<?php
require "config.php";
//Checks whether a user is logged in 
if(isset($_SESSION['username'])){
	$in_username=$_SESSION['username'];
}
else{
	//redirects to login page if user not logged in
	header("Location: login.php");
	exit();}
?>
<html>
<head>
	<title>Discover and Connect</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	
	<script src="assets/js/jquery.Jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>
	<script src="assets/js/demo.js"></script>


	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />

</head>
<body>
<div class="nav_bar">
	<div class="logo"><a href="index.php">Discover and Connect</a></div>
	<nav>
	<a href=""><i class="fa fa-user"></i></a>
	<a href=""><i class="fa fa-envelope"></i></a>
	<a href=""><i class="fa fa-user-friends"></i></a>
	<a href=""><i class="fa fa-bell"></i></a>
	<a href=""><i class="fa fa-power-off"></i></a>	
	</nav>
</div>
