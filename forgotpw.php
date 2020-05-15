<?php
require "config.php";
require "errors.php";

$fp_emailId="";
$fp_code=uniqid();

if(isset($_POST['fp_btn'])){
    $fp_emailId=strip_tags($_POST['fp_emailId']);
    $fp_emailId = filter_var($fp_emailId, FILTER_VALIDATE_EMAIL);   
    if (filter_var($fp_emailId, FILTER_VALIDATE_EMAIL))
    {        
        $fpe_check=mysqli_query($conn,"SELECT email FROM users WHERE email='$fp_emailId' ");
        $fpnum_rows=mysqli_num_rows($fpe_check);
        if ($fpnum_rows!=1)
        {
            array_push($error_array,"Email not registered");
        }
        else{
        	$fp_query=mysqli_query($conn,"SELECT * FROM reset_password WHERE email='$fp_emailId'");
        	$fp_num_rows=mysqli_num_rows($fp_query);
        	if($fp_num_rows==1){
        		$fp_query=mysqli_query($conn,"UPDATE reset_password SET code='$fp_code' WHERE email='$fp_emailId'");
        	}
        	elseif ($fp_num_rows==0) {
        		$fp_query=mysqli_query($conn,"INSERT INTO reset_password VALUES ('$fp_emailId', '$fp_code')");
        	}            
            if(!$fp_query){
                array_push($error_array, "Insertion error");
            }
        }
    }
    else{
        array_push($error_array,"Invalid Email format");
    }

}
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'discoverandcontent@gmail.com';                     // SMTP username
    $mail->Password   = 'discover@123';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged 
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('discoverandcontent@gmail.com', 'Discover and Connect');
    $mail->addAddress($fp_emailId);     // Add a recipient    
    //$mail->addReplyTo('info@example.com', 'Information');

    

    // Content
    $url="http://".$_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"])."/resetpw.php";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Discover and Connect Reset password';
    $mail->Body    = "Hi there!<br>Click on the link to reset your password for Discover and Connect.<br>Your code: $fp_code<br><a href='$url'>Click me</a>";
    $mail->AltBody = 'Go to this URL to reset your password: $url';

    $mail->send();
    array_push($error_array,'Message has been sent');
	} 
	catch (Exception $e) {
        ;
	    //array_push($error_array, "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
	}
?>
<html>
<head>
    <link rel="stylesheet" href="css/register_style.css">
    <title>Forgot password</title>
</head>
<body>
<div class="form_bg">
<h2>Forgot Password</h2>
<form action="forgotpw.php" method="post">

	<div class="error">
	<?php
	if(in_array("Message has been sent",$error_array)){echo "Message has been sent<br>";}
    /*if(in_array("Message could not be sent. Mailer Error: {$mail->ErrorInfo}",$error_array)){echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";}*/
    if(in_array("Insertion error",$error_array)){echo "Insertion error<br>";}
	?></div><br>

    <label for="fp_emailId">Email ID</label><br>
    <input type="email" id="fp_emailId" name="fp_emailId" required><br>
    <div class="error">
    <?php 
    if(in_array("Email not registered",$error_array)){echo "Email not registered<br>";}
    if(in_array("Invalid Email format",$error_array)){echo "Invalid Email format<br>";}    
    ?></div><br>

    <input type="submit" id="fp_btn" name="fp_btn" value="Submit"><br><br>
</form></div>

</body>
</html>