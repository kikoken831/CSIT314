
<!DOCTYPE HTML>
<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");

if(isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: index.php"); //redirect back to index.php
	exit();
}

if (isset($_GET['email'], $_GET['emailcode']) === true)
{
	$email = mysqli_real_escape_string($con,$_GET["email"]); //escapes special characters in a string
	$email = strip_tag($email); //function that take out unneccessary characters in a string
	$emailcode = mysqli_real_escape_string($con,$_GET["emailcode"]); //escapes special characters in a string
	$emailcode = strip_tag($emailcode); //function that take out unneccessary characters in a string
	$emailencrypt = encrypt($email, $key);
	
	
	$query=$con->prepare("SELECT COUNT(*) FROM users where emailcode = ? "); //check if user exists in database
	$query->bind_param('s', $emailcode); //bind parameter
	$query->execute(); //execute query
	$query->bind_result($count);
	$query->fetch(); //fetch query
	$query->close(); //close query
	if($count==1)
	{
		$query=$con->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND emailcode = ? AND active = 0"); //check if user exists in database
		$query->bind_param('ss',$emailencrypt, $emailcode); //bind parameter
		$query->execute(); //execute query
		$query->bind_result($count);
		$query->fetch(); //fetch query
		$query->close(); //close query
		if($count==1)
		{
			$query=$con->prepare("update users set active='1' where emailcode=?"); //update database
			$query->bind_param('s', $emailcode);
			if ($query->execute()) //execute query
			{
				?>
				<script type="text/javascript">
				alert("Your account is activated! You can login at the login page now.");
				window.location.href = "loginpage.php"; 
				</script>
			<?php
			}
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("You have already activated your account!");
				window.location.href = "index.php"; 
				</script>
			<?php
		}
	}
	else
	{
		?>
				<script type="text/javascript">
				alert("The activation code is invalid!");
				window.location.href = "index.php"; 
				</script>
			<?php
	}
}
else
{
	header("location: index.php");
	exit();
}
?>
