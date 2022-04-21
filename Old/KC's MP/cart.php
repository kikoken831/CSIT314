
<!DOCTYPE HTML>
<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");

include ("include/sessiontimeout.php");
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
			<div class="table-responsive">
				<form action ="cart.php" method="post" class="cartcontain" enctype="multipart/form-data">
				<?php getToken(); ?>
					<?php
						if(isset($_SESSION['sess_user_id']))
						{
							if ($_SESSION["noofcartitem"] == 0)
							{
								echo "<b><p align = 'center' class='emptycart'>Your cart is empty</p>";
								echo "<p><a href='alacarte.php' align='center' class='emptycart1'>Click here to browse our products</a></p>";
							}
							else
							{
								$userid = $_SESSION['sess_user_id'];
								//$username = $_SESSION["username"];
								$query = $con->prepare("SELECT cart.id, name, image, cart.quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE userid = ?"); //select from database where username will get the value from $username
								$query->bind_param('i', $userid); //bind the parameters
								$query->execute(); //execute query
								$query->bind_result($id, $itemname, $image, $quantity, $price);
								echo "<table class='table-responsive table-hover table-bordered table-striped table-condensed' data-compression='5' data-min='10' data-max='25' data-width='100%' data-height='100%' data-adjust-parents='true' data-styled='true' cellpadding='0' cellspacing='0' align='center'>";
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
									echo "<td><img src='productimages/$image' width='100' height='100' /></td>";
									//echo "<td>$quantity</td>";
									echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."'></td>";
									echo "<td>$$price</td>";
									echo "<td><a href='cart.php?Delete=delete&id=".$id."'>Delete</td>"; //delete button
									echo "</tr>";
								}

								$query = $con->prepare ("SELECT SUM( cart.quantity * price ) AS total FROM cart INNER JOIN products ON cart.itemid = products.id WHERE userid = ?"); //calculate the sum of totalprice in database
								$query->bind_param('i', $userid); //bind the parameter
								$query->execute(); //execute query
								$query->bind_result ( $result );
								$query->fetch(); //fetch query result
								$query->close(); //close query
														
								$query = $con->prepare("select cart.id, image, name, cart.quantity, pprice from cart inner join package on cart.packageid = package.id where userid = ?");
								$query->bind_param('i', $userid); //bind the parameters
								$query->execute(); //execute query
								$query->bind_result($id, $image, $itemname, $quantity, $price);
								while ($query->fetch())
								{
									$subtotal += $price;
				
									echo "<tr>"; //echo table row
									$itemid='<input type="hidden" name="id[]" value="'.$id.'" />';
									echo $itemid;
									echo "<td>$itemname</td>"; //echo data
									echo "<td><img src='productimages/$image' width='100' height='100' /></td>";
									//echo "<td>$quantity</td>";
									echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."' readonly></td>";
									echo "<td>$$price</td>";
									echo "<td><a href='cart.php?Delete=delete&id=".$id."'>Delete</td>"; //delete button
									echo "</tr>";
								}
								$result += $subtotal;
								echo "</table>"; //echo table
								echo "<td><input type='hidden' name='itemid' value='".$itemid."'</td>"; //echo data
								echo "<b><p align = 'center' class='subtotal'>Sub Total: $$result</p></b>";
								echo getTokenField();
								echo "<p><input type='submit' name='update' value='Update' class='updatebutton'></p></br>";
								echo "</br>";
								echo "<p><a href='delivery.php' class='checkoutbutton'>Click here to checkout</a></p>";
							}
							
						}
						
						if (!isset($_SESSION['sess_user_id']))
						{
							if ($_SESSION["noofcartitem"] == 0)
							{
								echo "<b><p align = 'center' class='emptycart'>Your cart is empty</p></b>";
								echo "<p><a href='alacarte.php'>Click here to browse our products</a></p>";
							}
							else
							{
								$ip = getIp();
								$query = $con->prepare("SELECT cart.id, name, image, cart.quantity, price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE ipaddr = ?"); //select from database where username will get the value from $username
								$query->bind_param('s', $ip); //bind the parameters
								$query->execute(); //execute query
								$query->bind_result($id, $itemname, $image, $quantity, $price);
								echo "<table class='table-responsive table-hover table-bordered table-striped table-condensed' data-compression='5' data-min='10' data-max='25' data-width='100%' data-height='100%' data-adjust-parents='true' data-styled='true' cellpadding='0' cellspacing='0' align='center'>";
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
										echo "<td><img src='productimages/$image' width='100' height='100' /></td>";
										//echo "<td>$quantity</td>";
										echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."'></td>";
										echo "<td>$$price</td>";
										echo "<td><a href='cart.php?Delete=delete&id=".$id."'>Delete</td>"; //delete button
										echo "</tr>";
								}
								
								
								$query = $con->prepare ("SELECT SUM( cart.quantity * price ) AS total FROM cart INNER JOIN products ON cart.itemid = products.id WHERE ipaddr = ?"); //calculate the sum of totalprice in database
								$query->bind_param('s', $ip); //bind the parameter
								$query->execute(); //execute query
								$query->bind_result ( $result );
								$query->fetch(); //fetch query result
								$query->close(); //close query
								
								$query = $con->prepare("select cart.id, image, name, cart.quantity, pprice from cart inner join package on cart.packageid = package.id where ipaddr = ?");
								$query->bind_param('s', $ip); //bind the parameters
								$query->execute(); //execute query
								$query->bind_result($id, $image, $itemname, $quantity, $price);
								while ($query->fetch())
								{
									$subtotal += $price;
									echo "<tr>"; //echo table row
									$itemid='<input type="hidden" name="id[]" value="'.$id.'" />';
									echo $itemid;
									echo "<td>$itemname</td>"; //echo data
									echo "<td><img src='productimages/$image' width='100' height='100' /></td>";
									//echo "<td>$quantity</td>";
									echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."' readonly></td>";
									echo "<td>$$price</td>";
									echo "<td><a href='cart.php?Delete=delete&id=".$id."'>Delete</td>"; //delete button
									echo "</tr>";
								}
								$result += $subtotal;
								echo "</table>"; //echo table
								echo "<td><input type='hidden' name='itemid' value='".$itemid."'</td>"; //echo data
								echo "<b><p align = 'center' class='subtotal'>Sub Total: $$result</p></b>";
								echo getTokenField();
								echo "<p><input type='submit' name='update' value='Update' class='updatebutton'></p></br>";
								echo "</br>";
								echo "<p><a href='loginpage.php' class='checkoutbutton'>You have to login to checkout.</a></p>";
								
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
							if (ctype_digit($id))
							{
								$query = $con->prepare ("Delete from cart where id = '$id' "); //delete from cart
								$query->execute(); //query execute
								$query=$con->prepare("ALTER TABLE cart AUTO_INCREMENT =1;"); //Reset auto increment Value
								if ($query->execute())
								{
									header("location:cart.php"); 
								}
							}
							else
							{
								header("location:404.php"); 
								exit;
							}
							
						}
						else
						{
							header("location:404.php"); 
							exit;
						}
					}
					
					if ( isset ($_POST["update"]))
					{
						$token = mysqli_real_escape_string($con,$_POST["token"]);
						checkToken($token);
						destroyToken();
						$quantity = $_POST['quantity'];
						$id = $_POST['id'];
					
							foreach ($id as $index => $itemid)
							{
								if (ctype_digit($quantity[$index]))
								{
									$query = $con->prepare("UPDATE cart set quantity = '$quantity[$index]' where id = '$id[$index]'"); //update the database
									if ($query->execute()) //execute query
									{
										header("location:cart.php"); 
									}
								}
								else
								{
									?>
									<script type="text/javascript">
									alert("Please input a number only");
									window.location.href = "cart.php";
									</script>
									<?php
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