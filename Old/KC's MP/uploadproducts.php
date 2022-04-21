<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");


if(!isset($_SESSION['adminid']))
{
	header("location:adminindex.php");
	exit;
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
			
			<form action="uploadproducts.php" method="post"
			enctype="multipart/form-data" id="insertform">
			<table align="center" width="300">
				<?php getToken(); ?>
				<tr align="center">
					<td colspan="10"><h2>Insert New Product</h2></td>
				</tr>

				<tr>
					<td align="center"><b>Title:</b></td>
					<td><input type="text" name="title" size="30" required></td>
				</tr>

				<tr>
					<td align="center"><b>Category:</b></td>
					<td><select name="category" required>
							<option>Select a Category</option>
							<?php
							$cat = "select * from categories";

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
					<td align="center"><b>Description:</b></td>
					<td><textarea name="description" cols="30" rows="4" required></textarea>
					</td>
				</tr>

				<tr>
					<td align="center"><b>Price:</b></td>
					<td><input type="text" name="price" required></td>
				</tr>
				
				<tr>
					<td align="center"><b>Quantity:</b></td>
					<td><input type="number" name="quantity" required></td>
				</tr>

				<tr>
					<td align="center"><b>Image:</b></td>
					<td><input type="file" name="image" required></td>
				</tr>
				
				<tr>
					<td align><b>Constant:</b></td>
					<td><input type="checkbox" name="checkbox" value="constant"></td>
				</tr>
				<?php echo getTokenField(); ?>
				<tr>
					<td align="center" colspan="10"><input type="submit" name="submit"
						value="Insert product"></td>
				</tr>



			</table>
		</form>
		
		<?php
		if(isset($_POST['submit']))
		{
			$token = mysqli_real_escape_string($con,$_POST["token"]);
			checkToken($token);
			destroyToken();
			
			$title = mysqli_real_escape_string($con, $_POST["title"]); //escapes special characters in a string
			$title = strip_tag($title); //function that take out unneccessary characters in a string
			$category = mysqli_real_escape_string($con, $_POST["category"]); //escapes special characters in a string
			$category = strip_tag($category); //function that take out unneccessary characters in a string
			$description = mysqli_real_escape_string($con, $_POST["description"]); //escapes special characters in a string
			$description = strip_tag($description); //function that take out unneccessary characters in a string
			$price = mysqli_real_escape_string($con, $_POST["price"]); //escapes special characters in a string
			$price = strip_tag($price); //function that take out unneccessary characters in a string
			$quantity = mysqli_real_escape_string($con, $_POST["quantity"]); //escapes special characters in a string
			$quantity = strip_tag($quantity); //function that take out unneccessary characters in a string
			$checkbox = $_POST['checkbox'];
				
			$image = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			
			if( !empty($title) && !empty($category) && !empty($description) && !empty($price) && !empty($image) && !empty($quantity)) //check if input is empty
			{
				if (is_numeric($price))
				{
					if (ctype_digit($quantity))
					{
						if(check_productname1($title))
						{
							if ($checkbox == 'constant')
							{
								$checkbox = 1;
							}
							else
							{
								$checkbox = 0;
							}
							move_uploaded_file($image_tmp,"productimages/$image");

							$query = $con->prepare("INSERT INTO products (category, name, price, quantity, description, image, constant) VALUES (?,?,?,?,?,?,?)"); //insert into database
							$query->bind_param('isdissi', $category, $title, $price, $quantity, $description, $image, $checkbox); //bind parameters
							if ($query->execute())  //check if query is executed
							{
								?>
								<script type="text/javascript">
								alert("Product Inserted");
								window.location.href = "uploadproducts.php";
								</script>
								<?php
							}
							else
							{
								?>
								<script type="text/javascript">
								alert("Error!");
								window.location.href = "uploadproducts.php";
								</script>
								<?php
							}
						}
						else
						{
							?>
							<script type="text/javascript">
							alert("Only letters allowed for Title");
							window.location.href = "uploadproducts.php";
							</script>
							<?php
						}
					}
					else
					{
						?>
						<script type="text/javascript">
							alert("Only numbers allowed for Quantity");
							window.location.href = "uploadproducts.php";
							</script>
						<?php
					}
				}
				else
				{
					?>
					<script type="text/javascript">
						alert("Please insert valid price");
						window.location.href = "uploadproducts.php";
						</script>
					<?php
				}
				
			}
			else
			{
				?>
					<script type="text/javascript">
						alert("Please fill in all the blanks.");
						window.location.href = "uploadproducts.php";
						</script>
				<?php
			}
			
		}


		?>
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