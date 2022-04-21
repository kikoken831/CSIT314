
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
	header("location:index.php");
	exit;
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
			   <img src="images/logo3.png" alt="One-stopbbq logo">
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
			
			if (isset($_GET['amt'], $_GET['cc'], $_GET['tx']) === true)
			{
				$amount = $_GET['amt'];
				$currency = $_GET['cc'];
				$trx_id = $_GET['tx'];
				
				unset ($_SESSION['payment']);
				$userid = $_SESSION['sess_user_id'];
				//$username = $_SESSION["username"];
				$query = $con->prepare ("SELECT SUM( cart.quantity * price ) AS total FROM cart INNER JOIN products ON cart.itemid = products.id WHERE userid = ?"); //calculate the sum of totalprice in database
				$query->bind_param('i', $userid); //bind the parameter
				$query->execute(); //execute query
				$query->bind_result ( $result );
				$query->fetch(); //fetch query result
				$query->close(); //close query
				
				$query = $con->prepare ("SELECT SUM( pprice ) FROM cart WHERE userid = ?"); //calculate the sum of totalprice in database
				$query->bind_param('i', $userid); //bind the parameter
				$query->execute(); //execute query
				$query->bind_result ( $pprice );
				$query->fetch(); //fetch query result
				$query->close(); //close query
				
				$result += $pprice;
				
				if ($amount == $result)
				{
					
					$query = "SELECT itemid, quantity FROM cart WHERE userid = $userid and itemid != 0"; //get products details that was purchased
					
					$runquery = mysqli_query($con, $query); 
						
					while($row = mysqli_fetch_array($runquery))
					{
						$query1 = "SELECT cart.quantity * price AS price FROM cart INNER JOIN products ON cart.itemid = products.id WHERE userid = $userid"; //get products details that was purchased
					
						$runquery1 = mysqli_query($con, $query1); 
							
						while($row1 = mysqli_fetch_array($runquery1))
						{
							$price = $row1['price'];
							$productid = $row['itemid'];
							$quantity = $row['quantity'];
							$query = $con->prepare("INSERT INTO payments (amount, userid, productid, packageid, trxid, quantity, currency) VALUES (?,?,?,0,?,?,?)"); //insert into database
							$query->bind_param('diisis', $price, $userid, $productid, $trx_id, $quantity, $currency); //bind parameters
							$query->execute(); //execute query
							
							$query->close();
							$query = $con->prepare("INSERT INTO orders (productid, packageid, userid, quantity, amountpaid) VALUES (?,0,?,?,?)"); //insert into database
							$query->bind_param('iiid', $productid, $userid, $quantity, $price); //bind parameters
							$query->execute(); 
							$query->close();
						}
						
					}
					
					$query3 = "SELECT packageid, quantity, pprice FROM cart WHERE userid = $userid and packageid != 0"; //get package details that was purchased.
					
					$runquery3 = mysqli_query($con, $query3); 
						
					while($row3 = mysqli_fetch_array($runquery3))
					{
							$packageid = $row3['packageid'];
							$quantity = $row3['quantity'];
							$pprice = $row3['pprice'];
							$query = $con->prepare("INSERT INTO payments (amount, userid, productid, packageid, trxid, quantity, currency) VALUES (?,?,0,?,?,?,?)"); //insert into database
							$query->bind_param('diisis', $pprice, $userid, $packageid, $trx_id, $quantity, $currency); //bind parameters
							$query->execute(); //execute query
							$query->close();
							
							$query = $con->prepare("INSERT INTO orders (productid, packageid, userid, quantity, amountpaid) VALUES (0,?,?,?,?)"); //insert into database
							$query->bind_param('iiid', $packageid, $userid, $quantity, $pprice); //bind parameters
							$query->execute();
							$query->close();
						
					}
					
					$query = $con->prepare("delete FROM cart WHERE userid = ?");   //prepare sql query
					//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
					$query->bind_param('i', $userid);   //i-integer, d-double, s-string, b-blob
					if ($query->execute())	
					{
						echo "<b><p align = 'center'>Welcome:".$_SESSION['username']."</br>"."Your payment was successful!</p></b>";
						echo "<p><a href='paymenthistory.php'>Go to view your orders</a></p>";
						
					}
					else
					{
						echo "<h1>Sorry, Error!!!</h1>";
					}
				}
				else
				{
					echo "<b><p align = 'center'>Sorry, payment was not successful.</p></b>";
					echo "<p><a href='cart.php'>Go back to cart</a></p>";
				}
			}
			else
			{	
				header("location:404.php");
				exit;	
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