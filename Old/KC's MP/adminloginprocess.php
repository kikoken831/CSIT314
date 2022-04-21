<?php
						if ( isset ($_POST["login"])) //check if login button is clicked
						{
							$token = mysqli_real_escape_string($con,$_POST["token"]);
							checkToken($token);
							destroyToken();
							$recaptcha=$_POST['g-recaptcha-response']; //recaptcha
							$username = mysqli_real_escape_string($con, $_POST["username"]); //escapes special characters in a string
							$username = strip_tag($username); //function that take out unneccessary characters in a string
							$password = mysqli_real_escape_string($con, $_POST["password"]); //escapes special characters in a string
							$password = strip_tag($password); //function that take out unneccessary characters in a string

							if( !empty($username) && !empty($password) && !empty($recaptcha)) //check if input is empty
							{
								$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeGKQsTAAAAAFzL6QBX_OA2-Yk-Pm3mw_baXrQX&response=".$recaptcha);
								if($response ==true)
								{
									if (check_username($username))
									{
										if (check_password($password))
										{
											$query = $con->prepare("select salt from adminusers WHERE adminusername = ?");
											$query->bind_param('s', $username); //bind the parameters
											$query->execute(); //execute query
											$query->bind_result($salt);
											$query->fetch(); //fetch query
											$query->close(); //close query

											$password = hash('sha256', $password);
											$verifypassword = hash('sha256', $salt . $password);

											$query= $con->prepare("select adminid, adminusername, password from adminusers WHERE adminusername=?"); //selecting username and password from database
											$query->bind_param('s', $username); //bind the param
											$query->execute(); //excute query

											$query->bind_result($adminid, $username, $storedhash);
											$query->fetch(); //fetch query

											if ($verifypassword == $storedhash) //check if both hash matches
											{
												
												session_regenerate_id(); //replace the current session id with a new one
												$_SESSION['adminid'] = $adminid; //creating a new session
												$_SESSION["adminusername"] = $username; ////creating a new session
												session_write_close(); //End the current session and store session data.
												$_SESSION['admintimeout'] = time(); ////creating a new session
												header("location:adminindex.php"); //go to index.php after logging in
													//header("index.php");
											}
											else
											{
												?>
													<script type="text/javascript">
													alert("Incorrect username or password");
													window.location.href = "adminlogin.php"; 
													</script>
												<?php
											}
										}
										else
										{
											?>
											<script type="text/javascript">
										alert("Incorrect username or password");
										window.location.href = "adminlogin.php";
										</script>
											<?php
										}
									}
									else
									{
										?>
											<script type="text/javascript">
											alert("Incorrect username or password");
											window.location.href = "adminlogin.php";
											</script>
										<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Captcha is incorrect");
										window.location.href = "adminlogin.php";
										</script>
									<?php
								}
							}	
							else
							{
								?>
						<script type="text/javascript">
		alert("Please fill in all blanks/Enter the Recaptcha");
		window.location.href = "adminlogin.php";
		</script>
						<?php
							}
						}

						?>