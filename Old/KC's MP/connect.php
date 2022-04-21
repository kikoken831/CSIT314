<?php

$con = mysqli_connect ( "127.0.0.1", "onesfswb_root", "Passw0rd!" , "onesfswb_mpdatabase"); //connect to database
if (!$con)
{
	die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
}

//$con = mysqli_connect ( "localhost", "Bing", "" , "project"); //connect to database
//if (!$con)
//{
//	die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
//}


?>