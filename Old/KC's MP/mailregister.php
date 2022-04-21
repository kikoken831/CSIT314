<?php
													require 'phpmailer/class.smtp.php';
													include 'phpmailer/class.phpmailer.php';
													$mail = new PHPMailer();
													//$mail->SMTPDebug = 3;                               // Enable verbose debug output
													
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

													$mail->Subject = 'One-StopBBQ Account Activation';
													$mail->Body    = "Hello <b>".$firstname."</b>, <br/><br/>
													
													Thanks for signing up!<br/><br/>
													Your account has been created. You can login with the following credentials after you have activated your account by pressing the url below.<br/><br/>
													 
													------------------------<br/><br/>
													Username: <b>$username</b><br/><br/>
													Password: <b>$password</b><br/><br/>
													------------------------<br/><br/>
													 
													Please click this link to activate your account:<br/><br/>
													https://www.one-stopbbq.com/verify.php?email=" .$email. "&emailcode=" .$emailcode. "<br/><br/>
													
													
													-One-StopBBQ";
?>