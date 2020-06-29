<?php
ob_start();

$timezone=date_default_timezone_set("Asia/Kolkata");
$conn=mysqli_connect("localhost","root","","dnc");
if(mysqli_connect_errno())
{
	echo "Error Occurred".mysqli_connect_errno();
}

$error_array=array();

?>