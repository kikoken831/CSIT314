
<?php
session_start();
include ("function.php");

$servername="localhost";
$username="root";
$serverpw="";
$dbname="restaurant";
$dbtable="coupon";

$conn = new mysqli($servername, $username, $serverpw, $dbname);
if ($conn->connect_error) { die("connection failed"); }
//print_r($menuArr); //test array set

if(isSet($_POST['coupon']))
{
	$coupon = $_POST['coupon'];
	$coupon = mysqli_real_escape_string($conn,$_POST["coupon"]); //escapes special characters in a string
	$coupon = strip_tag($coupon); //function that take out unneccessary characters in a string

	$query=$conn->prepare("select `COUPON ID`, `DISCOUNT RATE` from coupon where `coupon code` = ? "); //check if user exists in database
	$query->bind_param('s',$coupon); //bind parameter
	$query->execute(); //execute query
	$query->bind_result($couponid, $discRate);
	$query->fetch(); //fetch query
	$query->close(); //close query
	if($couponid !="")
	{
		$_SESSION['discRate'] = $discRate;
		$_SESSION['couponid'] = $couponid;
		die('Promo code is applied.');

	}
	else
	{
		unset($_SESSION['discRate']);
		unset($_SESSION['couponid']);
		die('Invalid promo code.');
	}
}

?>

