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
	$("#firstname").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var firstname = $(this).val();

		var pattern = new RegExp(/^[a-zA-Z]+$/);
		if (!pattern.test(firstname))
		{
			$("#firstname-result").html('It should only contain letters');
			 $('#firstname').css('border-color', '#FB3A3A');
			return;
			
		}
		else
		{
			$("#firstname-result").html('');
			$('#firstname').css('border-color', '');
			return;
			
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#lastname").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var lastname = $(this).val();

		var pattern = new RegExp(/^[a-zA-Z]+$/);
		if (!pattern.test(lastname))
		{
			$("#lastname-result").html('It should only contain letters');
			$('#lastname').css('border-color', '#FB3A3A');
			return;
			
		}
		else
		{
			$("#lastname-result").html('');
			$('#lastname').css('border-color', '');
			return;
			
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#phone").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var phone = $(this).val();

		var pattern = new RegExp(/^[689]\d{7}$/);
		if (!pattern.test(phone))
		{
			$("#phone-result").html('Invalid phone number!');
			$('#phone').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#phone-result").html('');
			$('#phone').css('border-color', '');
			return;
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#email").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var email = $(this).val();
		var pattern = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
		if (!pattern.test(email))
		{
			$("#email-result").html('Invalid email!');
			$('#email').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#email-result").html('<img src="images/ajax-loader.gif" />');
			$.post('emailcheck.php', {'email':email}, function(data) {
			  $("#email-result").html(data);
			});
			$('#email').css('border-color', '');
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#username").keyup(function (e) {
	
		//removes spaces from username
		$(this).val($(this).val().replace(/\s/g, ''));
		
		var username = $(this).val();
		var pattern = new RegExp (/^(?=.*[0-9])(?=.*[a-z])([a-z0-9_]+){8,}$/);
		if(!pattern.test(username))
		{
			$("#user-result").html('Username should be at least 8 characters long, includes:</br>1 lower case, 1 digit. Underscore is allowed.');
			$('#username').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#user-result").html('<img src="images/ajax-loader.gif" />');
			$.post('usernamecheck.php', {'username':username}, function(data) {
			  $("#user-result").html(data);
			});
			$('#username').css('border-color', '');
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#password").keyup(function (e) {
	
		//removes spaces from username
		//$(this).val($(this).val().replace(/\s/g, ''));
		
		var password = $(this).val();
		var pattern = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/);
		if (!pattern.test(password))
		{
			$("#password-result").html('Password must be at least 8 characters long with at least 1 Upper case, 1 Lower case & 1 digit!');
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
				<?php getToken(); ?>
				<form action="registersubmit.php" method="post" id="register-form" autocomplete="off" align="center">
				
				<h2>Registration Form</h2>

				<div id="form-content">
					<fieldset>

						<div class="fieldgroup">
							<label for="firstname">First Name : </label> <input
								name="firstname" type="text" id="firstname" maxlength="15"
								required> <span id="firstname-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="lastname">Last Name : </label><input name="lastname"
								type="text" id="lastname" maxlength="15" required> <span
								id="lastname-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="phone">Phone : </label><input name="phone" type="tel"
								id="phone" minlength="8" maxlength="8" required> <span id="phone-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="email">Email : </label><input name="email" type="text"
								id="email" maxlength="50" required> <span id="email-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="username">Username : </label> <input name="username"
								type="text" id="username" maxlength="15" required> <span
								id="user-result"></span>

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
							<div class="registerbutton">
								<input type="submit" value="Register" class="submit"
									name="register" id="registerbutton" align="center">
							</div>
						</div>

					</fieldset>

				</div>
				<div class="fieldgroup">
					<p>
						Already registered? <a href="loginpage.php"></br>Sign in</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</div>

<!--footer start here-->
<?php
include("footer.php");

?>
</html>