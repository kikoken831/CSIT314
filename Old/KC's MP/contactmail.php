<?php
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");
include ("include/sessiontimeout.php");
//if "email" variable is filled out, send email
if ( isset ($_POST["submit"]))
{
	$token = mysqli_real_escape_string($con,$_POST["token"]);
	checkToken($token);
	destroyToken();
	
	if(isset($_POST['url']) && $_POST['url'] == '')
	{
		$name = mysqli_real_escape_string($con,$_POST["name"]); //escapes special characters in a string
		$name = strip_tag($name); //function that take out unneccessary characters in a string
		$email = mysqli_real_escape_string($con,$_POST["email"]); //escapes special characters in a string
		$email = strip_tag($email); //function that take out unneccessary characters in a string
		$phone = mysqli_real_escape_string($con,$_POST["phone"]); //escapes special characters in a string
		$phone = strip_tag($phone); //function that take out unneccessary characters in a string
		$message = strip_tag($_POST["message"]); //function that take out unneccessary characters in a string
		
		if (!empty($name) && !empty($email) && !empty($phone))
		{
			if(check_name($name))
			{
				if(check_email($email))
				{
					if (check_phone($phone) && ctype_digit($phone))
					{
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
														$mail->AddReplyTo($email, $name);
														$mail->From = 'webmaster@one-stopbbq.com';
														$mail->FromName = 'One-StopBBQ';             // Name is optional
														$mail->AddAddress('onestopbbq@gmail.com');

														$mail->IsHTML(true);                                  // Set email format to HTML

														$mail->Subject = 'One-StopBBQ Feedback/Questions';
														$mail->Body    = "The following message/feedback is from <b>".$name."</b>, contact number: <b>".$phone." <br/><br/>
														
														The following below is the message/feedback: <br/><br/>
														<i>".$message."</i>
														";
						if($mail->Send())
						{
							?>
							<script type="text/javascript">
								alert("You have sent an email to us! We will reply to your email as soon as possible!");
								window.location.href = "contact.php"; 
							</script>
							<?php
						}
						else
						{
							?>
							<script type="text/javascript">
								alert("Error");
								window.location.href = "contact.php"; 
							</script>
							<?php
						}
					}
					else
					{
						?>
						<script type="text/javascript">
							alert("Your mobile number is incorrect");
							window.location.href = "contact.php"; 
						</script>
						<?php
					}
				}
				else
				{
					?>
					<script type="text/javascript">
						alert("Email is incorrect!");
						window.location.href = "contact.php"; 
					</script>
					<?php
				}
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Name can only consists of letters!");
					window.location.href = "contact.php"; 
				</script>
				<?php
			}
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("Please fill in all the blanks!");
				window.location.href = "contact.php"; 
				</script>
			<?php
		}
	}
	else	
	{
		header('location:404.php');
		exit;
	}
}

?>