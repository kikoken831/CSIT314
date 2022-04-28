
<?php

include ("function.php");

$servername="localhost";
$username="root";
$serverpw="";
$dbname="restaurant";
$dbtable="customer";

$conn = new mysqli($servername, $username, $serverpw, $dbname);
if ($conn->connect_error) { die("connection failed"); }
//print_r($menuArr); //test array set

if(isSet($_POST['email']))
{
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($conn,$_POST["email"]); //escapes special characters in a string
	$email = strip_tag($email); //function that take out unneccessary characters in a string

	$query=$conn->prepare("select count(*) from customer where email = ? "); //check if user exists in database
	$query->bind_param('s',$email); //bind parameter
	$query->execute(); //execute query
	$query->bind_result($count);
	$query->fetch(); //fetch query
	$query->close(); //close query
	if($count==0)
	{
		die('');

	}
	else
	{
		die('Email was already registered.');
	}
}

?>

