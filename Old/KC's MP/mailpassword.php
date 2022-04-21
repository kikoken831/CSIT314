<?php
													require 'phpmailer/class.smtp.php';
													include 'phpmailer/class.phpmailer.php';
													$mail = new PHPMailer();
													//$mail->SMTPDebug = 3;                               // Enable verbose debug output
													$code = bin2hex(openssl_random_pseudo_bytes(16));
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
													
													To reset your password for One-stopBBQ, click on this link below and copy paste the code: <br/><br/>
													Link: https://www.one-stopbbq.com/resetpassword.php<br/><br/>
													Code: <b>$code</b> <br/><br/>
													
													Please ignore this message if you didn't reset your password.<br/><br/>
													
													-One-StopBBQ";
													
													
?>
