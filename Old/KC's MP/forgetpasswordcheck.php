<?php
session_start();
ob_start();
include ("include/function.php");
include ("include/connect.php");


if(isset ($_POST["submit"])) //check is register button is clicked
{
	$token = mysqli_real_escape_string($con,$_POST["token"]);
	checkToken($token);
	destroyToken();
	$email = mysqli_real_escape_string($con,$_POST["email"]); //escapes special characters in a string
	$email = strip_tag($email); //function that take out unneccessary characters in a string
	$username = mysqli_real_escape_string($con,$_POST["username"]); //escapes special characters in a string
	$username = strip_tag($username); //function that take out unneccessary characters in a string
	
	if(!empty($email) && !empty($username)) //check if inputs are empty
	{
		?>
		<script type="text/javascript">
			alert("Please enter one of the inputs ONLY!");
			window.location.href = "forgetpassword.php"; 
			</script>
		<?php
	}
	else if (!empty($email))
	{
		$emailencrypt = encrypt($email, $key);
		$query=$con->prepare("select count(*) from users where email = ? "); //check if user exists in database
		$query->bind_param('s',$emailencrypt); //bind parameter
		$query->execute(); //execute query
		$query->bind_result($count);
		$query->fetch(); //fetch query
		$query->close(); //close query
		if($count==1)
		{
			$query= $con->prepare("select userid, firstname, username from users WHERE email=?"); //selecting username and password from database
			$query->bind_param('s', $emailencrypt); //bind the param
			$query->execute(); //excute query
			$query->bind_result($id, $firstname, $username);
			$query->fetch(); //fetch query
			
			require 'mailpassword.php';
			
			if($mail->send())
			{
				$query->close();
				$query = $con->prepare("INSERT INTO token (userid, token) VALUES (?,?)"); //insert into database
				$query->bind_param('is', $id, $code); //bind parameters
				if ($query->execute()) //execute query
				{
					?>
						<script type="text/javascript">
						alert("A reset code will be sent to your email.");
						window.location.href = "resetpassword.php"; 
						</script>
					<?php
				}
				else
				{
					?>
						<script type="text/javascript">
						alert("Error!");
						window.location.href = "forgetpassword.php"; 
						</script>
					<?php
				}
			}					
			else
			{
					?>
						<script type="text/javascript">
						alert("Error!");
						window.location.href = "forgetpassword.php"; 
						</script>
					<?php
			}
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("Email does not exist!");
				window.location.href = "forgetpassword.php"; 
				</script>
			<?php
		}
			
	}
	else if (!empty($username))
	{
		$query=$con->prepare("select count(*) from users where username = ? "); //check if user exists in database
		$query->bind_param('s',$username); //bind parameter
		$query->execute(); //execute query
		$query->bind_result($count);
		$query->fetch(); //fetch query
		$query->close(); //close query
		if($count==1)
		{
			$query= $con->prepare("select userid, firstname, email from users WHERE username=?"); //selecting username and password from database
			$query->bind_param('s', $username); //bind the param
			$query->execute(); //excute query
			$query->bind_result($id, $firstname, $encryptemail);
			$query->fetch(); //fetch query
			
			$email = decrypt($encryptemail, $key);
			require 'mailpassword.php';
			
			if($mail->send())
			{
				$query->close();
				$query = $con->prepare("INSERT INTO token (userid, token) VALUES (?,?)"); //insert into database
				$query->bind_param('is', $id, $code); //bind parameters
				if ($query->execute()) //execute query
				{
					?>
						<script type="text/javascript">
						alert("A reset code will be sent to your email.");
						window.location.href = "resetpassword.php"; 
						</script>
					<?php
				}
				else
				{
					?>
						<script type="text/javascript">
						alert("Error!");
						window.location.href = "forgetpassword.php"; 
						</script>
					<?php
				}
			}					
			else
			{
					?>
						<script type="text/javascript">
						alert("Error!");
						window.location.href = "forgetpassword.php"; 
						</script>
					<?php
			}
		}
		else
		{
			?>
				<script type="text/javascript">
				alert("Username does not exist!");
				window.location.href = "forgetpassword.php"; 
				</script>
			<?php
		}
	}
	else
	{
		?>
				<script type="text/javascript">
				alert("Please enter either one of the fields!");
				window.location.href = "forgetpassword.php"; 
				</script>
			<?php
	}

}
?>