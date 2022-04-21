<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");


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

<?php
if ( isset ($_POST["update"])) //check is update button is clicked
{
	$token = mysqli_real_escape_string($con,$_POST["token"]);
	checkToken($token);
	destroyToken();
	$itemid = $_SESSION['itemid'];
	$productname = mysqli_real_escape_string($con,$_POST["productname"]); //escapes special characters in a string
	$productname = strip_tag($productname); //function that take out unneccessary characters in a string
	$category = mysqli_real_escape_string($con,$_POST["category"]); //escapes special characters in a string
	$category = strip_tag($category); //function that take out unneccessary characters in a string
	$price = mysqli_real_escape_string($con,$_POST["price"]); //escapes special characters in a string
	$price = strip_tag($price); //function that take out unneccessary characters in a string
	$quantity = mysqli_real_escape_string($con,$_POST["quantity"]); //escapes special characters in a string
	$quantity = strip_tag($price); //function that take out unneccessary characters in a string
	$description = mysqli_real_escape_string($con,$_POST["description"]); //escapes special characters in a string
	$description = strip_tag($description); //function that take out unneccessary characters in a string
	if(isset($_POST['checkbox']))
	{
		$constant = 1;
	}
	else
	{
		$constant = 0;
	}
	
	if( !empty($productname) && !empty($category) && !empty($price) && !empty($quantity) && !empty($description)) //check if inputs are empty
	{
		if(check_productname1($productname))
		{
			if(is_numeric($price))
			{
				if (ctype_digit($quantity))
				{
					
					$query=$con->prepare("update products set category='$category' , name='$productname', price='$price', quantity='$quantity' , description='$description', constant='$constant' where id=?"); //update database
					$query->bind_param('i', $itemid);
					if ($query->execute()) //execute query
					{
						?>
							<script type="text/javascript">
							alert("Updated successfully!");
							window.location.href = "editproducts.php"; 
							</script>
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
							alert("Please try again!");
							window.location.href = "editproductsprocess.php"; 
							</script>
						<?php
					}
				}	
				else
				{
					?>
						<script type="text/javascript">
						alert("Quantity must be in digits");
						window.location.href = "editproductsprocess.php"; 
						</script>
					<?php
				}
			}
			else
			{
				?>
					<script type="text/javascript">
					alert("Please enter a valid price");
					window.location.href = "editproductsprocess.php"; 
					</script>
				<?php
			}
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("Product name only should consists of letters");
				window.location.href = "editproductsprocess.php"; 
				</script>
			<?php
		}
	}
	else
	{
		?>
			<script type="text/javascript">
			alert("Please fill in the necessary blanks");
			window.location.href = "editproductsprocess.php"; 
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
			<?php
			
				if(isset($_SESSION['adminid'])) //check if session is set
				{
					if (isset($_GET['itemid']))
					{
						$itemid = $_GET['itemid'];
						$_SESSION['itemid'] = $itemid;
						$query=$con->prepare("select category, name, price, quantity, description, constant from products where id = ?"); //select from database
						$query->bind_param('i',$itemid);
						$query->execute();
						$query->bind_result($category, $itemname, $price, $quantity, $description, $constant); //bind result
						$query->fetch();
						$query->close();
						
						$_SESSION['category'] = $category;
						$_SESSION['itemname'] = $itemname;
						$_SESSION['price'] = $price;
						$_SESSION['quantity'] = $quantity;
						$_SESSION['description'] = $description;
						$_SESSION['constant'] = $constant;
						
					}
					else
					{
						$itemid = $_SESSION['itemid'];
						$query=$con->prepare("select category, name, price, quantity, description, constant from products where id = ?"); //select from database
						$query->bind_param('i',$itemid);
						$query->execute();
						$query->bind_result($category, $itemname, $price, $quantity, $description, $constant); //bind result
						$query->fetch();
						$query->close();
						
						$_SESSION['category'] = $category;
						$_SESSION['itemname'] = $itemname;
						$_SESSION['price'] = $price;
						$_SESSION['quantity'] = $quantity;
						$_SESSION['description'] = $description;
						$_SESSION['constant'] = $constant;
					}
				}
			
			?>
			
			<form action="editproductsprocess.php" method="post" align="center"
						autocomplete="off">
				<table align="center" width="400">
						<?php getToken(); ?>
				<h1 align="center">Edit Product Page</h1>
			
					<tr>
						<td align="center"><b>Product Name:</b></td>
						<td><input type="text" name="productname" size="30" value='<?php echo $_SESSION['itemname']?>' required></td>
					</tr>
					
					<tr>
						<td align="center"><b>Category:</b></td>
						<td>
						<select name="category" required>
						<?php
						$category = $_SESSION['category'];
						$query=$con->prepare("select cat_title from categories where id = ?"); //select from database
						$query->bind_param('i',$category);
						$query->execute();
						$query->bind_result($title); //bind result
						$query->fetch();
						$query->close();
						
						?>
							<option value='<?php echo $_SESSION['category']?>'><?php echo $title ?></option>
							<?php							
							$cat = "select * from categories where id != $category";

							$query = mysqli_query($con, $cat);
							while ($row = mysqli_fetch_array($query))
							{
								$id = $row['id'];
								$cat = $row['cat_title'];
								echo "<option value='$id'>$cat</option>";
							}
							?>
					</select>
						
						</td>
					</tr>

					<tr>
						<td align="center"><b>Price:</b></td>
						<td><input type="number" name="price" min="0" value='<?php echo $_SESSION['price']?>' required></td>
					</tr>
						
						
					<tr>
						<td align="center"><b>Quantity:</b></td>
						<td><input type="number" name="quantity" min="0" value='<?php echo $_SESSION['quantity']?>' required></td>
					</tr>
					
					<tr>
						<td align="center"><b>Description:</b></td>
						<td><textarea name="description" cols="35" rows="15" required><?php echo $_SESSION['description']?></textarea></td>
					</tr>
					
					<?php
					if ($_SESSION['constant'] ==1)
					{
						echo "<tr>
						<td align='center'><b>Constant:</b></td>
						<td align='left'><input type='checkbox' name='checkbox' checked></td>
						</tr>";
					}
					else
					{
						echo "<tr>
						<td align='center'><b>Constant:</b></td>
						<td align='left'><input type='checkbox' name='checkbox'></td>
						</tr>";
					}
					
					?>
					
					<tr>
						<td align="center" colspan="10"><input type="submit" name="update"
						value="Update product"></td>
					</tr>
					<tr>
						<td align="center" colspan="10"><input action="action" type="button" value="Back" onclick="history.go(-1);" /></td>
					</tr>
							<?php echo getTokenField(); ?>			

				</table>
			</form>
			
			
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