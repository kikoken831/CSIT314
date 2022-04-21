
<?php 

include ("include/function.php");
include ("include/connect.php");

if(isSet($_POST['username']))
{
	$username = $_POST['username'];
	
	$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
	$username = strip_tag($username); //function that take out unneccessary characters in a string
	
	if (check_username($username))
	{
		$query=$con->prepare("select count(*) from users where username = ? "); //check if user exists in database
		$query->bind_param('s',$username); //bind parameter
		$query->execute(); //execute query
		$query->bind_result($count);
		$query->fetch(); //fetch query
		$query->close(); //close query
		if($count==0)
		{
			die('<img src="images/available.png" alt="Available"/>');
			
		}
		else
		{
			
			die('<img src="images/Unavailable.png" alt="Not Available" />');
		}
	}

}




?>
