
<!DOCTYPE HTML>
<?php

session_start();
if(isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: index.php"); //redirect back to index.php
	exit();
}
include ("include/function.php");
include ("include/connect.php");

?>

<html>
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
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#password").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var password = $(this).val();
		var pattern = new RegExp(/^.*(?=.{8,})(?=.*[0-9]).*$/);
		if (!pattern.test(password))
		{
			$("#password-result").html('Password must be at least 8 characters long with 1 digit!');
			$('#password').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#password-result").html('');
			$('#password').css('border-color', '');
			return;
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#retypepassword").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var retypepassword = $(this).val();
		var password = $("#password").val();
		if (password != retypepassword)
		{
			$("#retypepassword-result").html('Password does not match!');
			$('#retypepassword').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#retypepassword-result").html('');
			$('#retypepassword').css('border-color', '');
			return;
		}
	});	
});
</script>
</head>
<body>
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
				<form action="resetpassword.php" method="post" id="reset-form" autocomplete="off">
				<?php getToken(); ?>
					<h2 align="center">Reset Password</h2>
						<div class="fieldgroup">
							<label for="code">Code : </label><input name="code"
								type="text" id="code" placeholder="Code sent to your email" required> <span
								id="code-result"></span>
						</div>
							
						<div class="fieldgroup">
							<label for="password">Password : </label><input name="password"
								type="password" id="password" required> <span
								id="password-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="retypepassword">Retype Password : </label><input
								name="retypepassword" type="password" id="retypepassword"
								required> <span id="retypepassword-result"></span>
						</div>
						<?php echo getTokenField(); ?>
						<div class="fieldgroup">
							<p class="right" align="center">
							<input type="submit" name="reset" value="Reset Password" />
						
						</div>
				</form>
				<?php				
				if (isset ($_POST["reset"]))
				{
					$token = mysqli_real_escape_string($con,$_POST["token"]);
					checkToken($token);
					destroyToken();
					$code = mysqli_real_escape_string($con,$_POST['code']);
					$code = strip_tag($code); 
					$password = mysqli_real_escape_string($con,$_POST['password']);
					$password = strip_tag($password); 
					$retypepassword = mysqli_real_escape_string($con,$_POST['retypepassword']);
					$retypepassword = strip_tag($retypepassword); 
					
					if( !empty($code) && !empty($password) && !empty($retypepassword)) //check if inputs are empty
					{
							$query= $con->prepare("SELECT userid FROM token WHERE token = ?"); //selecting username and password from database
							$query->bind_param('i', $code); //bind the param
							$query->execute(); //excute query
							$query->bind_result($userid);
							$query->fetch(); //fetch query
							$query->close(); //close query
									
							$query=$con->prepare("SELECT token FROM token WHERE userid = ? ORDER BY DATETIME DESC LIMIT 1"); //check if user exists in database
							$query->bind_param('s',$userid); //bind parameter
							$query->execute(); //execute query
							$query->bind_result($tokencheck);
							$query->fetch(); //fetch query
							$query->close(); //close query
							if($code == $tokencheck)
							{
								if ($password == $retypepassword)
								{
									if(check_password($password))
									{
										$hash = hash('sha256', $password);
										$salt = createSalt();	
										$password = hash('sha256', $salt . $hash);
											
										$query=$con->prepare("update users set password='$password', salt='$salt' where userid= ? "); //update database
										$query->bind_param('i', $userid);
										if ($query->execute()) //execute query
										{
											$query->close();
											$query=$con->prepare("update token set used='1' where token= ? "); //update database
											$query->bind_param('s', $code);
											if ($query->execute()) //execute query
											{
												?>
														<script type="text/javascript">
														alert("Your password is changed successfully. You can log in now.");
														window.location.href = "loginpage.php"; 
														</script>
												<?php
											}
											else
											{
												?>
													<script type="text/javascript">
														alert("Error.");
														window.location.href = "resetpassword.php"; 
														</script>
													<?php
											}
										}
										else
										{
											?>
												<script type="text/javascript">
													alert("Error.");
													window.location.href = "resetpassword.php"; 
													</script>
												<?php
										}
									}
									else
									{
										?>
											<script type="text/javascript">
											alert("Password must be at least 8 characters and including at least 1 digit!");
											window.location.href = "resetpassword.php"; 
											</script>
										<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Password does not match");
										window.location.href = "resetpassword.php"; 
										</script>
									<?php
								}
							}
							else
							{
								?>
									<script type="text/javascript">
									alert("Your code have expired/incorrect code. Please use an updated code that was sent to your email.");
									window.location.href = "resetpassword.php"; 
									</script>
								<?php
							}
						
					}
					else
					{
						?>
							<script type="text/javascript">
							alert("Please fill in all the blanks");
							window.location.href = "resetpassword.php"; 
							</script>
						<?php
					}
				}
			?>
			</div>
		</div>
	</div>
</div>

<!--footer start here-->
<?php
include("footer.php");

?>
</html>