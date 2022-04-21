
<?php 

include ("include/function.php");
include ("include/connect.php");

if(isSet($_POST['email']))
{
	$email = $_POST['email'];

	$email = mysqli_real_escape_string($con,$_POST["email"]); //escapes special characters in a string
	$email = strip_tag($email); //function that take out unneccessary characters in a string
	$email = encrypt($email, $key);

	$query=$con->prepare("select count(*) from users where email = ? "); //check if user exists in database
	$query->bind_param('s',$email); //bind parameter
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

?>

