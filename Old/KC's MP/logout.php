<?php
include ("include/connect.php");
session_start();

if(isset($_SESSION['sess_user_id']))
{
	$userid = $_SESSION['sess_user_id'];
	$query = $con->prepare ("Delete from onlineusers where userid = '$userid' "); //delete from cart
	$query->execute(); //query execute
	$query=$con->prepare("ALTER TABLE onlineusers AUTO_INCREMENT =1;"); //Reset auto increment Value
	if ($query->execute())
	{
		header("location:cart.php"); 
	}

	session_destroy();

	header("location:index.php");
}
else
{
	header("location:index.php");
}



?>