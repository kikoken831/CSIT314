
<!DOCTYPE HTML>
<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");

?>
<html>
<script src='https://www.google.com/recaptcha/api.js'></script>
<head>
<title>One-Stop BBQ</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"
	media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--Google Fonts-->
<link
	href='http://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic'
	rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Courgette'
	rel='stylesheet' type='text/css'>
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
	rel='stylesheet' type='text/css'>


</head>
<body>
	<!--header start here-->
	<div class="header">
		<div class="container">
			<div class="logo">
				<div id="search" align="right">
					<?php 
					echo "<br/>";
					?>
					<form method="post" action="results.php"
						enctype="multipart/form-data">
						<input type="text" name="searchquery"
							placeholder="Search any products!" /> <input type="submit"
							name="search" value="Search" />

					</form>
				</div>
				<div class="logintext">
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
				<div class="cartheader">
					<?php 
						getcart();
						echo "<a href='cart.php'>Cart:</a>" . $_SESSION["noofcartitem"];
					?>
				</div>
				<div class="welcometext">
					<?php 

					if(!isset($_SESSION['sess_user_id']))
					{
						echo "Welcome Guest!"."<br />";
							
					}

					else{
					echo "<a href='profile.php' class='welcometexthover'>Welcome " . $_SESSION["username"] . "<br />";
				   }

				   ?>
				</div>
				<div class="header-main">
					<a href="index.php"><img src="images/logo2.png" alt=""> </a>
				</div>
				<div class="top-nav">
					<span class="menu"> <img src="images/icon.png" alt="" />
					</span>
					<ul class="nav nav-pills nav-justified res">
						<li><a href="index.php"><i
								class="glyphicon glyphicon-home"> </i>Home</a></li>
						<li><a class="icon" href="about.html"><i
								class="glyphicon glyphicon-star"> </i>About</a></li>
						<li><a href="alacarte.php"><i class="glyphicon glyphicon-picture"></i>AlaCarte</a>
						</li>
						<li><a href="pages.html"><i class="glyphicon glyphicon-list-alt">
							</i>Packages</a></li>
						<li><a href="blog.html"><i class="glyphicon glyphicon-thumbs-up">
							</i>Promotions</a></li>
						<li><a href="contact.html"><i class="glyphicon glyphicon-envelope">
							</i>Contact</a></li>
					</ul>

				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--header end here-->
	<div class="productcontainer">
			
			<form action ="cart.php" method="post" enctype="multipart/form-data">
			<?php
				if(isset($_SESSION['sess_user_id']))
				{
					if ($_SESSION["noofcartitem"] == 0)
					{
						echo "<b><p align = 'center' class='emptycart'>Your cart is empty</p>";
						echo "<a href='alacarte.php' align='center' class='emptycart1'>Click here to browse our products</a>";
					}
					else
					{
						$username = $_SESSION["username"];
						$query = $con->prepare("SELECT cart.id, name, image, quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE username = ?"); //select from database where username will get the value from $username
						$query->bind_param('s', $username); //bind the parameters
						$query->execute(); //execute query
						$query->bind_result($id, $itemname, $image, $quantity, $price);
						echo "<table border='1px' >";
						echo "<tr>";
						echo "<th>Item Name</th>";
						echo "<th>Image</th>";
						echo "<th>Quantity</th>";
						echo "<th>Per Price ($)</th>";
						echo "<th></th>";
						echo "</tr>";
						while ($query->fetch())
						{
							
							echo "<tr>"; //echo table row
							$itemid='<input type="hidden" name="id[]" value="'.$id.'" />';
							echo $itemid;
							echo "<td>$itemname</td>"; //echo data
							echo "<td><img src='productimages/$image' width='80' height='80' /></td>";
							//echo "<td>$quantity</td>";
							echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."'></td>";
							echo "<td>$$price</td>";
							echo "<td><a href='cart.php?Delete=delete&id=".$id."'>Delete</td>"; //delete button
							echo "</tr>";
						}

						$query = $con->prepare ("SELECT SUM( quantity * price ) AS total FROM cart INNER JOIN products ON cart.itemid = products.id WHERE username = ?"); //calculate the sum of totalprice in database
						$query->bind_param('s', $username); //bind the parameter
						$query->execute(); //execute query
						$query->bind_result ( $result );
						$query->fetch(); //fetch query result
						$query->close(); //close query
						
						
						echo "</table>"; //echo table
						echo "<td><input type='hidden' name='itemid' value='".$itemid."'</td>"; //echo data
						echo "<b><p align = 'center' class='subtotal'>Sub Total: $$result</p></b>";
						echo "<input type='submit' name='update' value='Update' class='updatebutton'></br>";
						echo "</br>";
						echo "<a href='payment.php' class='paymentcenter'>Click here to checkout</a>";
					}
					
				}
				
				if (!isset($_SESSION['sess_user_id']))
				{
					if ($_SESSION["noofcartitem"] == 0)
					{
						echo "<b><p align = 'center' class='emptycart'>Your cart is empty</p><\n>";
						echo "<a href='alacarte.php' align='center'>Click here to browse our products</a>";
					}
					else
					{
					$ip = getIp();
					$query = $con->prepare("SELECT cart.id, name, image, quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE ipaddr = ?"); //select from database where username will get the value from $username
					$query->bind_param('s', $ip); //bind the parameters
					$query->execute(); //execute query
					$query->bind_result($id, $itemname, $image, $quantity, $price);
					echo "<table border='1px' >";
					echo "<tr>";
					echo "<th>Item Name</th>";
					echo "<th>Image</th>";
					echo "<th>Quantity</th>";
					echo "<th>Per Price ($)</th>";
					echo "<th></th>";
					echo "</tr>";
					while ($query->fetch())
					{
							echo "<tr>"; //echo table row
							$itemid='<input type="hidden" name="id[]" value="'.$id.'" />';
							echo $itemid;
							echo "<td>$itemname</td>"; //echo data
							echo "<td><img src='productimages/$image' width='80' height='80' /></td>";
							//echo "<td>$quantity</td>";
							echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."'></td>";
							echo "<td>$$price</td>";
							echo "<td><a href='cart.php?Delete=delete&id=".$id."'>Delete</td>"; //delete button
							echo "</tr>";
					}

					$query = $con->prepare ("SELECT SUM( quantity * price ) AS total FROM cart INNER JOIN products ON cart.itemid = products.id WHERE ipddr = ?"); //calculate the sum of totalprice in database
					$query->bind_param('s', $ip); //bind the parameter
					$query->execute(); //execute query
					$query->bind_result ( $result );
					$query->fetch(); //fetch query result
					$query->close(); //close query
					
					
					echo "</table>"; //echo table
					echo "<b><p align = 'center' class='subtotal'>Sub Total: $$result</p></b>";
					echo "<input type='submit' name='update' value='Update' class='updatebutton'>";
					}
					
				}
				
			?>
				
				
			</form>
	<?php
	if (isset ($_GET["Delete"])) 
	{
		if ($_GET["Delete"] == "delete") 
		{
			$id = $_GET["id"]; //get data from the form
			$query = $con->prepare ("Delete from cart where id = '$id' "); //delete from cart
			$query->execute(); //query execute
			$query=$con->prepare("ALTER TABLE cart AUTO_INCREMENT =1;"); //Reset auto increment Value
			if ($query->execute())
			{
				header("location:cart.php"); 
			}
		}
	}
	
	if ( isset ($_POST["update"]))
	{
		$quantity = $_POST['quantity'];
		$id = $_POST['id'];
		foreach ($id as $index => $itemid)
		{
			$query = $con->prepare("UPDATE cart set quantity = '$quantity[$index]' where id = '$id[$index]'"); //update the database
			if ($query->execute()) //execute query
			{
				header("location:cart.php"); 
			}
			//echo $quantity[$index];
			//echo $id[$index];
		}
	}
	
	?>
			

	</div>

	
	<!--banner start here-->

	<!--banner end here-->
	<!--banner info start here-->


	<!--footer start here-->
	<div class="footer">
		<div class="container">
			<div class="footer-main">
				<div class="col-md-3 footer-grid">
					<h3>Information</h3>
					<ul>
						<li><a class="active no-bar" href="index.html">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="services.html">Services</a></li>
						<li><a href="pages.html">Pages</a></li>
						<li><a href="blog.html">blog</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</div>
				<div class="col-md-3 footer-grid">
					<h3>My Account</h3>
					<p>
						<a href="#">My Account</a>
					</p>
					<p>
						<a href="contact.html">My Addresses</a>
					</p>
					<p>
						<a href="#">My Cart</a>
					</p>
				</div>
				<div class="col-md-3 footer-grid">
					<h3>Contact Us</h3>
					<h4>Coffee-bar</h4>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
						accusantium</p>
					<div class="ftr-cont">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span>
						<a href="#">mail@user.com</a>
					</div>
				</div>
				<div class="col-md-3 footer-grid">
					<h3>Follow Us</h3>
					<ul class="social-icon-ftr">
						<li><a href="#"><span class="fa"> </span> </a></li>
						<li><a href="#"><span class="tw"> </span> </a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
				<div class="copyright">
					<p>
						&copy 2015 One-Stop BBQ All rights reserved | <a
							href="http://w3layouts.com/" target="_blank"> </a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<!--footer end here-->

</body>
</html>



