<?php

if(isset($_POST['submitotp']))
{
	$userid = $_SESSION['sess_user_id'];


	$query = $con->prepare ("SELECT firstname, email FROM users WHERE userid = ?"); //calculate the sum of totalprice in database
	$query->bind_param('i', $userid); //bind the parameter
	$query->execute(); //execute query
	$query->bind_result ( $firstname, $email );
	$query->fetch(); //fetch query result
	$query->close(); //close query

	$email = decrypt($email, $key);

	$code = unique_id();

	$_SESSION['getotp'] = $code;
	$_SESSION['otptimeout'] = time();




													require 'phpmailer/class.smtp.php';
													include 'phpmailer/class.phpmailer.php';
													$mail = new PHPMailer();
													//$mail->SMTPDebug = 3;                               // Enable verbose debug output
													
													//$email = 'onestopbbq@gmail.com';
													$mail->IsSMTP(true);                                      // Set mailer to use SMTP
													$mail->Mailer = "smtp"; 
													$mail->Host = 'ssl://server169.web-hosting.com';  // Specify main and backup SMTP servers
													$mail->SMTPAuth = true;                               // Enable SMTP authentication
													$mail->Username = 'webmaster@one-stopbbq.com';                 // SMTP username
													$mail->Password = 'Passw0rd!';                           // SMTP password
													//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
													$mail->Port = 465;                                    // TCP port to connect to

													$mail->From = 'webmaster@one-stopbbq.com';
													$mail->FromName = 'One-StopBBQ';             // Name is optional
													$mail->AddAddress($email, 'User');

													$mail->IsHTML(true);                                  // Set email format to HTML

													$mail->Subject = 'One-StopBBQ Reset Password';
													$mail->Body    = "Hello <b>".$firstname."</b>, <br/><br/>
													
													This is your OTP. It is only valid for 3 mins.<br/><br/>
													Code: <b>$code</b> <br/><br/>
													
													-One-StopBBQ";

													if($mail->send())
													{
														echo "<script type='text/javascript'>alert('OTP had been sent to your email. Please check your email.');</script>";
													}
													else
													{
														echo "<script type='text/javascript'>alert('Error!');</script>";
													}


}
?>