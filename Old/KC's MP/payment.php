
<!DOCTYPE HTML>
<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");

include ("include/sessiontimeout.php");
if(!isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	?>
		<script type="text/javascript">
		alert("You have to login to pay");
		window.location.href = "loginpage.php"; 
		</script>
	<?php
}

if(!isset($_SESSION['payment']))
{
	header("location: index.php");
	exit();
}

if(isset($_SESSION['payment']) != 1)
{
	header("location: index.php");
	exit();
}

?>
<html>
<head>
<title>One-Stop BBQ</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


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
	<script type="text/javascript">
	  $(document).ready(function() {
		$('table.responsive').responsiveTables();
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
			 		<input type="search" name="searchquery" placeholder="Search any products!" />
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
					<li><a class="active" href="index.php"><i class="glyphicon glyphicon-home"> </i>Home</a></li>
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
			<?php
	
			/* $username = $_SESSION["username"];
			$query = $con->prepare("SELECT cart.id, name, quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE username = ?"); //select from database where username will get the value from $username
			$query->bind_param('s', $username); //bind the parameters
			$query->execute(); //execute query
			$query->bind_result($id, $itemname, $quantity, $price);
			while ($productdetails = mysqli_fetch_array($query))
			{
				$id = $productdetails['id'];
				$price = array($productdetails['price']);
				$itemname = array($productdetails['name']);
				
			}
			
			*/
			
			$userid = $_SESSION['sess_user_id'];
			//$query = "select * from cart where username='$username'";
			$query = "SELECT cart.id, name, cart.quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE userid = '$userid'";
			$query = mysqli_query($con, $query);
			while ($details = mysqli_fetch_array($query))
			{
			?>
				<h1 align="center">Pay now with Paypal: </h1>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				
				<!-- Identify your business so that you can collect the payments. -->
				<input type="hidden" name="business" value="onestopbusiness1@gmail.com">

				<!-- Specify a Buy Now button. -->
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="currency_code" value="SGD">

				<!-- Specify details about the item that buyers will purchase. -->
				<!--<input type="hidden" name="item_name" value="<?php echo $details['name']; ?>"> 
				<input type="hidden" name="amount" value="<?php echo $details['price']; ?>">
				<input type="hidden" name="quantity" value="<?php echo $details['quantity']; ?>">
				<input type="hidden" name="currency_code" value="SGD"> -->

				<?
					$userid = $_SESSION['sess_user_id'];
					//$query = "select * from cart where username='$username'";
					$query = "SELECT cart.id, name, cart.quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE userid = '$userid'";
					$query = mysqli_query($con, $query);
					$resultarray = array();
					while ($row = mysqli_fetch_array($query))
					{
						$resultarray[] = $row;
					}
					
					$i = 1;
					foreach($resultarray as $row)
					{
						?>
						<input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $row['name']; ?>"> 
						<input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $row['price']; ?>">
						<input type="hidden" name="quantity_<?php echo $i ?>" value="<?php echo $row['quantity']; ?>">
						<?php
						$i++;
					}
				?>
				
				<?php
				
					$userid = $_SESSION['sess_user_id'];
					//$query = "select * from cart where username='$username'";
					$query = "select name, quantity, pprice from cart inner join package on cart.packageid = package.id where userid = $userid";
					$query = mysqli_query($con, $query);
					$resultarray = array();
					while ($row = mysqli_fetch_array($query))
					{
						$resultarray[] = $row;
					}

					foreach($resultarray as $row)
					{
						?>
						<input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $row['name']; ?>"> 
						<input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $row['pprice']; ?>">
						<input type="hidden" name="quantity_<?php echo $i ?>" value="<?php echo $row['quantity']; ?>">
						<?php
						$i++;
					}
				
				?>

				<input type="hidden" name="return" value="https://www.one-stopbbq.com/paypalsuccess.php">
				<input type="hidden" name="cancel_return" value="https://www.one-stopbbq.com/paypalcancel.php">

				<!-- Display the payment button. -->
				<p><input type="image" name="submit" border="0"
				src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
				alt="PayPal - The safer, easier way to pay online">
				<img alt="" border="0" width="1" height="1"
				src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" ></p>

				</form>
							

				</div>
			<?php
				}
			?>			
		</div>
	</div>
</div>
<!--banner end here-->

<!--footer start here-->
<?php
include("footer.php");

?>
</html>