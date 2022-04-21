<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");
include ("include/sessiontimeout.php");
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
			<div class="product_box">
				<?php 
				if(isset($_POST['search']))
				{
					$search = mysqli_real_escape_string($con,$_POST["searchquery"]); //escapes special characters in a string

					if (!empty($search))
					{
						if(check_productname($search))
						{
							$query = "SELECT * FROM products WHERE name like '%$search%'"; //search the database for a specified pattern
							$run = mysqli_query ($con,$query);
							if (mysqli_num_rows($run)!=0) 
							{
								echo"<h1 align='center'>Ala Carte Menu</h1>";
								while ($row = mysqli_fetch_array($run))
								{
									$id = $row['id'];
									$cat = $row['category'];
									$title = $row['name'];
									$price = $row['price'];
									$image = $row['image'];
										
									echo"
									<div id='single_product'>
									<h3>$title</h3>
									<img src='productimages/$image' width='170' height='170' />
									<p><b> Price:$ $price </b></p>
									<a href='details.php?id=$id' style='float:left;'>Details</a>
									<a href='results.php?cart=$id'><button style='float:right'>Add to Cart</button></a>
									<div id ='productdetails'></div>
									</div>
									";
								}
							}
							else
							{
								echo "<p align='center'> <font color=black  size='4pt'>Product not found. Please search again.</font></p>";  
							}
						}
						else
						{
							echo "<p align='center'> <font color=black  size='4pt'>Please enter a valid name.</font></p>";  
						}
						
					}
					else
					{
						//echo "<script type='text/javascript'>alert('Please enter something in the textbox')</script>";
						//echo "Please enter something in the textbox";
						echo "<p align='center'> <font color=black  size='4pt'>Please enter something in the textbox</font></p>";  
					}
					
					
				}
				?>
				<?php 
				if(isset($_GET['cart']))
				{
					if(isset($_SESSION['sess_user_id']))
					{
						$id = $_GET['cart'];
						$userid = $_SESSION['sess_user_id'];
						//$username = $_SESSION["username"];
						$quantity = 1;
						$check1 = "select * from cart where userid='$userid' and itemid='$id'";
						$run1 = mysqli_query($con, $check1);
						if (mysqli_num_rows($run1)>0)
						{
							?>
								<script type="text/javascript">
									alert("You have already added this to the cart. Please go to the cart to edit the quantity");
									window.location.href = "cart.php";
								</script>
								<?php
						}
						else
						{
							$query = $con->prepare("insert into cart (userid, itemid, quantity) values(?,?,?)");   //prepare sql query
							//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
							$query->bind_param('iii', $userid, $id, $quantity);   //i-integer, d-double, s-string, b-blob
							if ($query->execute())
							{
								?>
								<script type="text/javascript">
									alert("Added to cart successfully!");
									window.location.href = "alacarte.php";
								</script>
								<?php
							}
							else{
								?>
								<script type="text/javascript">
									alert("Error!");
									window.location.href = "alacarte.php";
								</script>
								<?php
							}
						}

					}
					else
					{
						$ip = getIp();
						$id = $_GET['cart'];
						$quantity = 1;
						$check = "select * from cart where ipaddr='$ip' and itemid='$id'";
						$run = mysqli_query($con, $check);

						if (mysqli_num_rows($run)>0)
						{
							?>
								<script type="text/javascript">
									alert("You have already added this to the cart. Please go to the cart to edit the quantity");
									window.location.href = "cart.php";
								</script>
								<?php
						}
						else
						{
							$query = $con->prepare("insert into cart (ipaddr, itemid, quantity) values(?,?,?)");   //prepare sql query
							//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
							$query->bind_param('sii', $ip, $id, $quantity);   //i-integer, d-double, s-string, b-blob
							if ($query->execute())
							{
								?>
								<script type="text/javascript">
									alert("Added to cart successfully!");
									window.location.href = "alacarte.php";
								</script>
								<?php

							}
							else{
								?>
								<script type="text/javascript">
									alert("Error!");
									window.location.href = "alacarte.php";
								</script>
								<?php
							}
						}
					}

				}
				?>

			
			</div>
		</div>
	</div>
</div>
<!--banner end here-->

<!--footer start here-->
<?php
include("footer.php");

?>
</html>