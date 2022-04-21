<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");


if(!isset($_SESSION['adminid']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: adminlogout.php"); //redirect back to index.php
	exit();
}

if(isset($_SESSION['sess_user_id']))
{
	?>
		<script type="text/javascript">
		alert("You have entered a restricted zone.");
		window.location.href = "index.php";
		</script>
	<?php
}

getOnlineusers();
//include ("include/sessiontimeout.php");
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
<link href="css/astyle.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--Google Fonts-->
<!-- start-smoth-scrolling -->
<!-- //end-smoth-scrolling -->
</head>
<body>
<!--header start here-->
<div class="header">
   <div class="container">
    <h3 align="center">Admin Page</h3>
 </div>
</div>
<!--header end here-->
<!--banner start here-->
<div class="banner">
	<div class="container">
		<div class="banner-main">
			<div class="content">
			
				<?php
				
				if(isset($_SESSION['adminid']))
				{
					echo "<p>Welcome " . $_SESSION["adminusername"] . "</p></br>";
					echo "<p>No of Online Users: " . $_SESSION["onlineusers"] . "</p></br>";
				}
				else
				{
				}
				?>			
			  <div id="admin"><b id="admin_text">Admin Settings</b></div>
			  <div id="settings" class="fa fa-cog"></div>
			  <div id="menu">
				<div id="arrow"></div>
				<?php
				if(!isset($_SESSION['adminid']))
				{
					echo "<a href='adminlogin.php'>Login<i id='firstIcon'></i></a>";
				}
				else
				{
					echo "<a href='adminlogout.php'>Logout<i id='firstIcon' ></i></a>";
				}
				
				?>
				
				<a href="viewusers.php">View Users<i id="secondIcon" ></i></a>
				<a href="uploadproducts.php">Upload Products <i id="thirdIcon"></i></a>
				<a href="editproducts.php">Edit Products <i id="fourthIcon"></i></a>
				<a href="viewpaymenthistory.php">View Payment History <i id="fifthIcon"></i></a>
			  </div>
			</div>
			<div class="table-responsive">
				<?php
				
				getPaymenthistory();

				?>
			</div>
		</div>
	</div>
</div>
<!--banner end here-->
<!--banner info start here-->
<div class="bann-info">
	<div class="container">

        <script src="js/index.js"></script>
	</div>
</div>
</html>