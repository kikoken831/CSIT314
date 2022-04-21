<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");

if (isset($_SESSION['sess_user_id']))
{
	if (!isset($_SESSION['timeout']))
	{
		$_SESSION['timeout'] = time();
	}
	else if (time() - $_SESSION['timeout'] > 60)
	{
		?>
		<script type="text/javascript">
		alert("Your session have expired");
		window.location.href = "logout.php"; //direct to Logout.php
		</script>
		<?php
	}
	else
	{
		session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
		$_SESSION['timeout'] = time();
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
<script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
  function initialize() {
    var mapCanvas = document.getElementById('map');
    var map = new google.maps.Map(mapCanvas);
  }
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
			 
			<div class="logintext" align="right">
				   <?php 
				   
				   if(!isset($_SESSION['sess_user_id']))
				   {
				   	echo "<a href='loginpage.php'>Login</a>";
				   }
				   
				   else{
					echo "<a href='logout.php'>Logout</a>";
				   }
				  
				   ?>
			</div>
			<div class="cartheader" align="right">
				 	<?php 
				 		getCart();
				 		echo "<a href='cart.php'>Cart:</a>" . $_SESSION["noofcartitem"];	
				 	?>
			</div>	
			<div class="welcometext" align="right">
				   <?php 
				   
				   if(!isset($_SESSION['sess_user_id']))
				   {
				   	echo "Welcome Guest!"."<br />";
				   }
				   
				   else
				   {
					echo "<a href='profile.php' class='welcometexthover'>Welcome " . $_SESSION["username"] . "</a>";
				   }
				  
				   ?>

			</div>
				<?php
					echo "</br>";
					echo "</br>";
				   ?>
			<div id="search" align="right">
				<form method="post" action="results.php" enctype="multipart/form-data">
			 		<input type="text" name="searchquery" placeholder="Search any products!" />
			 		<input type="submit" name="search" value="Search" />
					 	
				</form>
			</div>
				<?php
					echo "</br>";
					echo "</br>";
				   ?>
            <div class="top-nav">
            	<span class="menu"> <img src="images/icon.png" alt=""/></span>
				<ul class="nav nav-pills nav-justified res">
					<li><a href="index.php"><i class="glyphicon glyphicon-home"> </i>Home</a></li>
					<li><a href="about.php"><i class="glyphicon glyphicon-star"> </i>About</a></li>
					<li><a href="alacarte.php"><i  class="glyphicon glyphicon-thumbs-up"> </i>Alacarte</a></li>
					<li><a href="packages.php"><i class="glyphicon glyphicon-list-alt"> </i>Packages</a></li>
					<li><a class="active" href="contact.php"><i class="glyphicon glyphicon-envelope"> </i>Contact</a></li>
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
<div class="contact">
	<div class="container">
		<div class="contact-main">
			<div class="contact-top">
				<h3>Contact/Feedback</h3>
				<p>You can contact us or give us feedback through our email or head down to our Headquarters</p>
			</div>
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8149819.804819931!2d109.61814849999999!3d4.1406339999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2sin!4v1435068868290"> </iframe>
			</div>
			<div class="contact-text">
					<div class="col-md-9 contact-left">
						<form action="contactmail.php" method="post" autocomplete="off" enctype="multipart/form-data">
						<?php getToken(); ?>
							<input name="name" type="text" id="name" maxlength="30" placeholder="Name" required>
							<input name="email" type="email" id="email" maxlength="30" placeholder="Email" required>
							<p class="antispam">Leave this empty: <input type="text" name="url" /></p>
							<input name="phone" type="tel" id="phone" minlength="8" maxlength="8" placeholder="Phone" required>
							
							<textarea name="message" placeholder="Message" required></textarea>
							<?php echo getTokenField(); ?>
							<input type="submit" value="SUBMIT" name="submit">
						</form>
					</div>	
					<div class="col-md-3 contact-right">
						<h3>Contact Info</h3>
						<h4>61238198</h4>
						<div class="address">
							<h5>Address</h5>
							<p>Old Airport Road, 
							<span>Avenue 3,</span>
							#12-34.</p>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

<!--banner end here-->
<!--banner info start here-->
<!--banner info end here-->
<!-- coff-online start here-->

<!--ccoff-online end here-->
<!--coff-bar start here-->

<!--culfy end here-->
<!--footer start here-->
<?php
include("footer.php");

?>
</html>