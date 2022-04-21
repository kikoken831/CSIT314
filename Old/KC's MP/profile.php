<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");

include ("include/sessiontimeout.php");

if(!isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	?>
		<script type="text/javascript">
		alert("You have to login to view profile");
		window.location.href = "index.php"; 
		</script>
	<?php
}

profile();

if ( isset ($_POST["update"])) //check is update button is clicked
{
	$token = mysqli_real_escape_string($con,$_POST["token"]);
	checkToken($token);
	destroyToken();
	$username = $_SESSION['username'];
	$firstname = mysqli_real_escape_string($con,$_POST["firstname"]); //escapes special characters in a string
	$firstname = strip_tag($firstname); //function that take out unneccessary characters in a string
	$lastname = mysqli_real_escape_string($con,$_POST["lastname"]); //escapes special characters in a string
	$lastname = strip_tag($lastname); //function that take out unneccessary characters in a string
	$phone = mysqli_real_escape_string($con,$_POST["phone"]); //escapes special characters in a string
	$phone = strip_tag($phone); //function that take out unneccessary characters in a string
	$email = mysqli_real_escape_string($con,$_POST["email"]); //escapes special characters in a string
	$email = strip_tag($email); //function that take out unneccessary characters in a string
	$emailencrypt = encrypt($email, $key);
	
	if( !empty($firstname) && !empty($lastname) && !empty($email) && !empty($phone)) //check if inputs are empty
	{
		if(check_name($firstname))
		{
			if(check_name($lastname))
			{
				if (check_phone($phone) && ctype_digit($phone)) //check if $phone is make up of digits, ending with 6/8/9
				{
					if(check_email($email))
					{
							$query=$con->prepare("select count(*) from users where email = ? and email NOT IN(SELECT email FROM products WHERE username=?);");//check if itemname exists in database, excluding $itemid
							$query->bind_param('ss',$emailencrypt,$username); //bind parameters
							$query->execute(); //execute query
							$query->bind_result($count);
							$query->fetch(); //fetch query
							$query->close(); //close query
							if($count==0)	
							{
								$query=$con->prepare("update users set firstname='$firstname' , lastname='$lastname', phone='$phone', email='$emailencrypt' where username=?"); //update database
								$query->bind_param('s', $username);
								if ($query->execute()) //execute query
								{
									?>
										<script type="text/javascript">
										alert("Updated successfully!");
										window.location.href = "profile.php"; 
										</script>
									<?php
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Please try again!");
										window.location.href = "profile.php"; 
										</script>
									<?php
								}
							}	
							else
							{
								?>
									<script type="text/javascript">
									alert("Email is in use! Please enter another email");
									window.location.href = "profile.php"; 
									</script>
								<?php
							}
					}
					else
					{
						?>
							<script type="text/javascript">
							alert("Email is not valid!");
							window.location.href = "profile.php"; 
							</script>
						<?php
					}
				}
				else
				{
					?>
						<script type="text/javascript">
						alert("Phone is not valid!");
						window.location.href = "profile.php"; 
						</script>
					<?php
				}
			}
			else
			{
				?>
					<script type="text/javascript">
					alert("Last name should only consists of letters.");
					window.location.href = "profile.php"; 
					</script>
				<?php
			}
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("First name should only consists of letters.");
				window.location.href = "profile.php"; 
				</script>
			<?php
		}
	}
	else
	{
		?>
			<script type="text/javascript">
			alert("Please fill up the blanks");
			window.location.href = "profile.php"; 
			</script>
		<?php
	}
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
			$.post('emailcheckprofile.php', {'email':email}, function(data) {
			  $("#email-result").html(data);
			});
			$('#email').css('border-color', '');
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
		
		<div class="col-md-3">
		  <ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="profile.php">Profile Page</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			<li><a href="changeemail.php">Change Email Address</a></li>
			<li><a href="paymenthistory.php">View Payment History</a></li>
		  </ul>
		</div>
		
		<form action="profile.php" method="post" id="profilepage"
						autocomplete="off">
						<?php getToken(); ?>
			<h1 align="center">Profile Page</h1>
			<div id="form-content">
				<fieldset>
					<div class="fieldgroup">
							<label for="firstname">First Name : </label> 
							<input name="firstname" type="text" id="firstname" maxlength="15" value='<?php echo $_SESSION['firstname']?>'
							required readonly> <span id="firstname-result"></span>
					</div>

					<div class="fieldgroup">
						<label for="lastname">Last Name : </label><input name="lastname"
						type="text" id="lastname" maxlength="15" value='<?php echo $_SESSION['lastname']?>' required readonly> <span
						id="lastname-result"></span>
					</div>

					<div class="fieldgroup">
						<label for="phone">Phone : </label><input name="phone"
						type="text" id="phone" minlength="8" maxlength="8" value='<?php echo $_SESSION['phone']?>' required> <span
						id="phone-result"></span>
					</div>

					<div class="fieldgroup">
							<label for="email">Email : </label><input name="email"
							type="text" id="email" value='<?php echo $_SESSION['email']?>' required readonly> <span id="email-result"></span>
					</div>
					<div class="fieldgroup">
						<p class="changepassbutton">
							<input type="submit" value="Update" class="submit" name="update">
						</p>
					</div>
					<?php echo getTokenField(); ?>			


				</fieldset>

			</div>
		</form>
	</div>
</div>

<!--footer start here-->
<?php
include("footer.php");

?>
</html>