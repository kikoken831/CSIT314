<?php 
session_start();
include ("include/function.php");
include ("include/connect.php");

if(isset($_GET['cart']))
{
	if(isset($_SESSION['sess_user_id']))
	{
		$id = $_GET['cart'];
		$userid = $_SESSION['sess_user_id'];
		//$username = $_SESSION["username"];
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
			$query = $con->prepare("insert into cart (userid, itemid) values(?,?)");   //prepare sql query
			//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
			$query->bind_param('ii', $userid, $id);   //i-integer, d-double, s-string, b-blob
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