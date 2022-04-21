<?
session_start();
if(isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: index.php"); //redirect back to index.php
	exit();
}
?>

<html>
	<head>
		<title> Payment Cancel!</title>
		
	</head>
	
	
<body>
	<h3>Hello <?php echo $_SESSION["username"];?>
	<h3> Payment was cancelled and not successful</h3>
	<h3><a href="cart.php">Go back to cart</h3>
		
</body>		
</html>


		
		