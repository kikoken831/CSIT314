<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");
include ("include/sessiontimeout.php");

if(!isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: index.php"); //redirect back to index.php
	exit();
}


if ( isset ($_POST["update"])) //check is update button is clicked
{
	$token = mysqli_real_escape_string($con,$_POST["token"]);
	checkToken($token);
	destroyToken();
	$username = $_SESSION['username'];
	$oldpass = mysqli_real_escape_string($con,$_POST["oldpassword"]); //escapes special characters in a string
	$oldpass = strip_tag($oldpass); //function that take out unneccessary characters in a string
	$newpass = mysqli_real_escape_string($con,$_POST["newpassword"]); //escapes special characters in a string
	$newpass = strip_tag($newpass); //function that take out unneccessary characters in a string
	$renewpass = mysqli_real_escape_string($con,$_POST["renewpassword"]); //escapes special characters in a string
	$renewpass = strip_tag($renewpass); //function that take out unneccessary characters in a string
	
	if( !empty($oldpass) && !empty($newpass) && !empty($renewpass)) //check if inputs are empty
	{
		$query = $con->prepare("select salt from users WHERE username = ?");
		$query->bind_param('s', $username); //bind the parameters
		$query->execute(); //execute query
		$query->bind_result($salt);
		$query->fetch(); //fetch query
		$query->close(); //close query

		$pass = hash('sha256', $oldpass);
		$verifypassword = hash('sha256', $salt . $pass);

		$query= $con->prepare("select password from users WHERE username=?"); //selecting username and password from database
		$query->bind_param('s', $username); //bind the param
		$query->execute(); //excute query

		$query->bind_result($storedhash);
		$query->fetch(); //fetch query

		if ($verifypassword == $storedhash) //check if both hash matches
		{
			if ($newpass == $renewpass)
			{
				if ($oldpass != $newpass)
				{
					if(check_password($newpass))
					{
						$hash = hash('sha256', $newpass);
						$salt = createSalt();	
						$password = hash('sha256', $salt . $hash);
						
						$query->close();
						$query=$con->prepare("update users set password='$password', salt='$salt' where username=?"); //update database
						$query->bind_param('s', $username);
						if ($query->execute()) //execute query
						{
							?>
								<script type="text/javascript">
								alert("Password changed successfully!");
								window.location.href = "profile.php"; 
								</script>
							<?php
						}
						else
						{
							?>
								<script type="text/javascript">
								alert("Please try again!");
								window.location.href = "changepassword.php"; 
								</script>
							<?php
						}
					}
					else
					{
						?>
							<script type="text/javascript">
							alert("Password must be at least 8 characters and including at least 1 digit!");
							window.location.href = "changepassword.php"; 
							</script>
						<?php
					}
				}
				else
				{
					?>
						<script type="text/javascript">
						alert("Choose a different password from your old password");
						window.location.href = "changepassword.php"; 
							</script>
						<?php
				}
			}
			else
			{
				?>
					<script type="text/javascript">
					alert("Password does not match");
					window.location.href = "changepassword.php"; 
					</script>
				<?php
			}
			
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("Old password is incorrect.");
				window.location.href = "changepassword.php"; 
				</script>
			<?php
		}
	}
	else
	{
		?>
			<script type="text/javascript">
			alert("Please fill up the blanks");
			window.location.href = "changepassword.php"; 
			</script>
		<?php
	}
}
			



?>
<!DOCTYPE HTML>
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
	$("#newpassword").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var password = $(this).val();
		var pattern = new RegExp(/^.*(?=.{8,})(?=.*[0-9]).*$/);
		if (!pattern.test(password))
		{
			$("#newpassword-result").html('Password must be at least 8 characters long with 1 digit!');
			$('#newpassword').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#newpassword-result").html('');
			$('#newpassword').css('border-color', '');
			return;
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#renewpassword").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var retypepassword = $(this).val();
		var password = $("#newpassword").val();
		if (password != retypepassword)
		{
			$("#retypepassword-result").html('Password does not match!');
			$('#renewpassword').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#retypepassword-result").html('');
			$('#renewpassword').css('border-color', '');
			return;
		}
	});	
});
</script>
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
	
		<div class="col-md-3">
		  <ul class="nav nav-pills nav-stacked">
			<li><a href="profile.php">Profile Page</a></li>
			<li class="active"><a href="changepassword.php">Change Password</a></li>
			<li><a href="changeemail.php">Change Email Address</a></li>
			<li><a href="paymenthistory.php">View Payment History</a></li>
		  </ul>
		</div>
	
		<div class="signin-form">
			<div class="signin">
				<div class="signin-main">
					<form action="changepassword.php" method="post" id="changepasswordpage"
						autocomplete="off">
						<?php getToken(); ?>
						<h1>Change Password</h1>
						<div id="form-content">
							<fieldset>
								<div class="fieldgroup">
									<label for="oldpassword">Old Password: </label> 
									<input name="oldpassword" type="password" id="oldpassword"
										required> <span id="oldpassword-result""></span>
								</div>

								<div class="fieldgroup">
									<label for="newpassword">New Password : </label><input name="newpassword"
										type="password" id="newpassword" required> <span
										id="newpassword-result"></span>
								</div>

								<div class="fieldgroup">
									<label for="renewpassword">Retype New Password : </label><input name="renewpassword"
										type="password" id="renewpassword" required> <span
										id="retypepassword-result"></span>
								</div>
								<?php echo getTokenField(); ?>
								<div class="fieldgroup">
									<p class="right">
										<input type="submit" value="Update" class="submit" name="update">
									</p>
								</div>

							</fieldset>

						</div>
						
						
					</form>
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