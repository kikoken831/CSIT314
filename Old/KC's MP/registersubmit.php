<?php
session_start();
include ("include/function.php");
include ("include/connect.php");


if ( isset ($_POST["register"])) //check is register button is clicked
{
	$token = mysqli_real_escape_string($con,$_POST["token"]);
	checkToken($token);
	destroyToken();
	$firstname = mysqli_real_escape_string($con,$_POST["firstname"]); //escapes special characters in a string
	$firstname = strip_tag($firstname); //function that take out unneccessary characters in a string
	$lastname = mysqli_real_escape_string($con,$_POST["lastname"]); //escapes special characters in a string
	$lastname = strip_tag($lastname); //function that take out unneccessary characters in a string
	$phone = mysqli_real_escape_string($con,$_POST["phone"]); //escapes special characters in a string
	$phone = strip_tag($phone); //function that take out unneccessary characters in a string
	$email = mysqli_real_escape_string($con,$_POST["email"]); //escapes special characters in a string
	$email = strip_tag($email); //function that take out unneccessary characters in a string
	$emailencrypt = encrypt($email, $key);
	$username = mysqli_real_escape_string($con,$_POST["username"]); //escapes special characters in a string
	$username = strip_tag($username); //function that take out unneccessary characters in a string
	$password = mysqli_real_escape_string($con,$_POST["password"]); //escapes special characters in a string
	$password = strip_tag($password); //function that take out unneccessary characters in a string
	$retypepassword = mysqli_real_escape_string($con,$_POST["retypepassword"]);  //escapes special characters in a string
	$retypepassword = strip_tag($retypepassword);
	
	if( !empty($firstname) && !empty($lastname) && !empty($email) && !empty($phone) && !empty($username) && !empty($password) && !empty($retypepassword)) //check if inputs are empty
	{
		if(check_username($username))
		{
			$query=$con->prepare("select count(*) from users where username = ? "); //check if user exists in database
			$query->bind_param('s',$username); //bind parameter
			$query->execute(); //execute query
			$query->bind_result($count);
			$query->fetch(); //fetch query
			$query->close(); //close query
			if($count==0)
			{
				if(check_name($firstname))
				{
					if(check_name($lastname))
					{
						if (check_phone($phone) && ctype_digit($phone)) //check if $phone is make up of digits, ending with 6/8/9
						{
							if(check_email($email))
							{
								$query=$con->prepare("select count(*) from users where email = ? "); //check if user exists in database
								$query->bind_param('s',$emailencrypt); //bind parameter
								$query->execute(); //execute query
								$query->bind_result($count);
								$query->fetch(); //fetch query
								$query->close(); //close query
								if($count==0)
								{
									if(check_password($password))
									{
										if($password == $retypepassword) //check if password match
										{
											$hash = hash('sha256', $password);
											$salt = createSalt();	
											$spassword = hash('sha256', $salt . $hash);
										
											$emailcode = md5($_POST["username"] + microtime());
										
											$query = $con->prepare("INSERT INTO users (firstname, lastname, phone, email, username, password, salt, emailcode, active) VALUES (?,?,?,?,?,?,?,?,0)"); //insert into database
											$query->bind_param('ssisssss', $firstname, $lastname, $phone, $emailencrypt, $username, $spassword, $salt, $emailcode); //bind parameters
											if ($query->execute()) //execute query
											{
													require 'mailregister.php';

													if($mail->send())
													{
														if (($_SESSION["noofcartitem"]) > 1)
														{
															$query->close();
															$ip = getIp();
															$query=$con->prepare("update cart set username='$username' where ipaddr=?"); //update database
															$query->bind_param('s', $ip);
															if ($query->execute()) //execute query
															{
																$query->close();
																$query1=$con->prepare("update cart set ipaddr = '' WHERE username=?;"); //update database
																$query1->bind_param('s', $username);
																if ($query1->execute()) //execute query
																{
																	?>
																		<script type="text/javascript">
																		alert("You have successfully registered. Please go to your email to activate your account!");
																		window.location.href = "index.php"; 
																		</script>
																	<?php
																}
																else
																{
																	?>
																		<script type="text/javascript">
																		alert("Error!");
																		window.location.href = "index.php"; 
																		</script>
																	<?php
																}
															}
															else
															{
																?>
																	<script type="text/javascript">
																	alert("Error!");
																	window.location.href = "index.php"; 
																	</script>
																<?php
																
															}
															
														}
														else
														{
															?>
																		<script type="text/javascript">
																		alert("You have successfully registered. Please go to your email to activate your account!");
																		window.location.href = "index.php"; 
																		</script>
																	<?php
														}
														
													}
													else
													{
														?>
														<script type="text/javascript">
														alert("Email couldn't be send!");
														window.location.href = "register.php"; 
														</script>
														<?php
													}
											}
											else
											{
													?>
														<script type="text/javascript">
														alert("Please try again!");
														window.location.href = "register.php"; 
														</script>
													<?php
											}
										}
										else
										{
													?>
														<script type="text/javascript">
														alert("Password does not match!");
														window.location.href = "register.php"; 
														</script>
													<?php
										}
									}
									else
									{
										?>
											<script type="text/javascript">
											alert("Password must be at least 8 characters and including at least 1 digit!");
											window.location.href = "register.php"; 
											</script>
										<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Email is used. Please use another email.");
										window.location.href = "register.php"; 
										</script>
									<?php
								}
							}
							else
							{
								?>
									<script type="text/javascript">
									alert("Please enter a valid email.");
									window.location.href = "register.php"; 
									</script>
								<?php
							}
						}
						else
						{
							?>
									<script type="text/javascript">
									alert("Please enter a valid phone number");
									window.location.href = "register.php"; 
									</script>
							<?php
						}
					}
					else
					{
						?>
								<script type="text/javascript">
								alert("Lastname should only contain letters");
								window.location.href = "register.php"; 
								</script>
						<?php
					}
				}
				else
				{
					?>
								<script type="text/javascript">
								alert("Firstname should only contain letters");
								window.location.href = "register.php"; 
								</script>
					<?php
				}
			}
			else
			{
				?>
							<script type="text/javascript">
							alert("Your desired username exists. Please choose another username");
							window.location.href = "register.php"; 
							</script>
				<?php
			}
		}
		else 
		{
			?>
						<script type="text/javascript">
						alert("Username should be at least 8 characters long, include: 1 lower case, 1 digit. Underscore is allowed.");
						window.location.href = "register.php"; 
						</script>
			<?php
		}
	}
	else
	{
		?>
					<script type="text/javascript">
					alert("Please fill in all the blanks");
					window.location.href = "register.php"; 
					</script>
		<?php
	}
}
?>