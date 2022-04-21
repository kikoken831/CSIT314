<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");

if(isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: index.php"); //redirect back to index.php
	exit();
}
?>
<!DOCTYPE HTML>
<html>
<script src='https://www.google.com/recaptcha/api.js'></script>
<head>
<title>One-Stop BBQ</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--Google Fonts-->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>

	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
<!-- //end-smoth-scrolling -->
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=289011751125169";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--header start here-->
<div class="header">
   <div class="container">
        <div class="header-main">
			 <div class="logo">
			   <a href="index.php"><img src="images/logo3.png" alt="One-stopbbq logo"></a>
			 </div>
			 
            <div class="top-nav">
            	<span class="menu"> <img src="images/icon.png" alt=""/></span>
				<ul class="nav nav-pills nav-justified res">
					<li><a  href="index.php"><i class="glyphicon glyphicon-home"> </i>Home</a></li>
					<li><a href="about.php"><i class="glyphicon glyphicon-star"> </i>About</a></li>
					<li><a href="alacarte.php"><i  class="glyphicon glyphicon-thumbs-up"> </i>Alacarte</a></li>
					<li><a href="packages.php"><i class="glyphicon glyphicon-list-alt"> </i>Packages</a></li>
					<li><a href="contact.php"><i class="glyphicon glyphicon-envelope"> </i>Contact</a></li>
				</ul>
				</ul>
				<!-- script-for-menu -->
							 <script>
							   $( "span.menu" ).click(function() {
								 $( "ul.res" ).slideToggle( 300, function() {
								 // Animation complete.
								  });
								 });
							</script>
			<!-- /script-for-menu -->
			 </div>	
     <div class="clearfix"> </div>
   </div>	
 </div>
</div>
<!--header end here-->
<!--banner start here-->
<div class="banner">
  <div class="container">
 	<div class="banner-main">
		<div class="signin-form">
			<div class="signin">
				<div class="signin-main">
					<?php getToken(); ?>
					<h3 align="center">Login Page</h3>
					<form action="loginpage.php" method="post" align="center">
						<div class="mess" align="center">
							<input type="text" class="active" id="username" name="username"
								maxlength=20 placeholder="Username" autocomplete="off" /> <span
								class="mess1"> </span>
						</div>
						<div class="mess" align="center">
							<input type="password" id="password" name="password" maxlength=20
								placeholder="Password" /> <span class="mess2"> </span>
						</div>
						<?php echo getTokenField(); ?>
						<div class="g-recaptcha" data-sitekey="6LeGKQsTAAAAAFYtt0MjLjz1vi1lGEFNs6hIXb91" align="center"></div>
						<div class="send">
							<input type="submit" value="Login" name="login">
						</div>

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
											$query = $con->prepare("select salt from users WHERE username = ?");
											$query->bind_param('s', $username); //bind the parameters
											$query->execute(); //execute query
											$query->bind_result($salt);
											$query->fetch(); //fetch query
											$query->close(); //close query

											$password = hash('sha256', $password);
											$verifypassword = hash('sha256', $salt . $password);

											$query= $con->prepare("select userid, username, password from users WHERE username=?"); //selecting username and password from database
											$query->bind_param('s', $username); //bind the param
											$query->execute(); //excute query

											$query->bind_result($userid, $username, $storedhash);
											$query->fetch(); //fetch query

											if ($verifypassword == $storedhash) //check if both hash matches
											{
												$query->close();
												$query = $con->prepare("select active from users WHERE username = ?");
												$query->bind_param('s', $username); //bind the parameters
												$query->execute(); //execute query
												$query->bind_result($active);
												$query->fetch(); //fetch query
												$query->close(); //close query
												if ($active == 1)
												{
													$query = $con->prepare("INSERT INTO onlineusers (userid) VALUES (?)"); //insert into database
													$query->bind_param('i', $userid); //bind parameters
													if ($query->execute()) //execute query
													{
														session_regenerate_id(); //replace the current session id with a new one
														$_SESSION['sess_user_id'] = $userid; //creating a new session
														$_SESSION["username"] = $username; ////creating a new session
														session_write_close(); //End the current session and store session data.
														$_SESSION['timeout'] = time(); ////creating a new session
														header("location:index.php"); //go to index.php after logging in
														//header("index.php");
													}
												}
												else
												{
													?>
														<script type="text/javascript">
														alert("Sorry, you have not register your account. Please go to your email to activate your account.");
														window.location.href = "loginpage.php";
														</script>
													<?php
												}
											}
											else
											{
												?>
													<script type="text/javascript">
													alert("Incorrect username or password");
													window.location.href = "loginpage.php"; 
													</script>
												<?php
											}
										}
										else
										{
											?>
											<script type="text/javascript">
										alert("Incorrect username or password");
										window.location.href = "loginpage.php";
										</script>
											<?php
										}
									}
									else
									{
										?>
											<script type="text/javascript">
											alert("Incorrect username or password");
											window.location.href = "loginpage.php";
											</script>
										<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Captcha is incorrect");
										window.location.href = "loginpage.php";
										</script>
									<?php
								}
							}	
							else
							{
								?>
						<script type="text/javascript">
		alert("Please fill in all blanks/Enter the Recaptcha");
		window.location.href = "loginpage.php";
		</script>
						<?php
							}
						}

						?>



					</form>
					<a href="forgetpassword.php"><p class="loginP">Forgot your password?</p> </a> <a
						href="register.php"><p class="loginP">Register</p> </a>
				</div>
			</div>
		</div>
	</div>
</div>

<!--footer start here-->
<?php
include("footer.php");

?>
</html>