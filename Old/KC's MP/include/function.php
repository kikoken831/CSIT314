<?php


function check_name($string)
{
	if (preg_match("/^([A-Za-z ])+$/", $string))
	{
		return TRUE;
	}
	return FALSE;
}

function check_password($string)
{
	// Password must be at least 8 characters and at least one upper case, one lower case, one digit
	if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $string))
	{
		return TRUE;
	}
	return FALSE;
}

function check_email($string)
{
	if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $string)){
		return true;
	}
	else{
		return false;
	}
}

function check_address($string) //contains Alphabets in Upper and lower case, numbers, hyphen, fullstops forward and back slash and commas and spaces
{
	if (preg_match("/[A-Za-z0-9\-\\,.]+/", $string)){
		return true;
	}
	else{
		return false;
	}
}

function checkvaliddate($string)
{
	if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $string))
	{
		return true;
	}
	else
	{
		return false;
	}
	
}


function checkvalidtime($string)
{
	if (preg_match("/(0?\d|1[0-2]):(0\d|[0-5]\d) (AM|PM)/i", $string))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function checkaddress($string)
{
	if (preg_match("/^[a-z0-9- ]+$/i", $string))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function checkpostal($string)
{
	if (preg_match("/^\d{6}$/", $string))
	{
		return true;
	}
	else
	{
		return false;
	}
}


function checkunit($string)
{
	if (preg_match("/^\d{1,3}(-\d{1,3})?$/", $string))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function checkblock($string)
{
	if (preg_match("/^[A-Za-z0-9- ]+$/", $string))
	{
		return true;
	}
	else
	{
		return false;
	}
}



function check_username ($string)
{
	//should contain at least one digit
	//should contain at least one lower case
	//can contain underscore
	//should contain at least 8 from the mentioned characters

	if (preg_match('/^(?=.*[0-9])(?=.*[a-z])([a-z0-9_]+){8,}$/', $string)){
		return true;
	}
	else{
		return false;
	}
}

$key = md5('SingOnStorezSing');

function createSalt()
{
	$text = md5(uniqid(rand(), true));
	return substr($text, 0, 22);
}

function encrypt($string, $key)
{
	$string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB)));
	return $string;
}

function decrypt($string, $key)
{
	$string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($string), MCRYPT_MODE_ECB));
	return $string;
}




function check_productname($string)
{
	if (preg_match("/^[\w\s ,.-]+$/", $string)) //check for letters, numbers and spaces
	{
		return TRUE;
	}
	return FALSE;
}

function check_productname1($string)
{
	if (preg_match("/^([a-zA-Z]+\s)*[a-zA-Z]+$/", $string)) //check for letters and spaces only
	{
		return TRUE;
	}
	return FALSE;
	
}

function strip_tag($string)
{
	$string = preg_replace ('/<[^>]*>/', ' ',$string);
	$string = str_replace("\r",'',$string);
	$string = str_replace("\n",'',$string);
	$string = str_replace("\t",'',$string);
	$string = trim(preg_replace('/ {2,}/', ' ',$string));
	return $string;
}

function check_phone($string)
{
	if (preg_match('/^[689]/',$string))
	{
		return TRUE;
	}
	return FALSE;
}


function getproducts(){


	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}

	$query = "select * from products order by name asc";
	$run = mysqli_query($con, $query);

	while($row = mysqli_fetch_array($run))
	{
		$id = $row['id'];
		$cat = $row['category'];
		$title = $row['name'];
		$price = $row['price'];
		$image = $row['image'];

		echo"
		<div id='single_product'>
		<h3>$title</h3>
		<img src='productimages/$image' width='170' height='170' />
		<p><b> Price:$ $price </b></p>
		<a href='details.php?id=$id' style='float:left;'>Details</a>
		<a href='alacarte.php?cart=$id'><button style='float:right' class='cartbutton'>Add to Cart</button></a>

		</div>
		";
	}
}

function getIp() {
	$ip = $_SERVER['REMOTE_ADDR'];

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	return $ip;
}

function getCart()
{
	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}

	if(isset($_SESSION['sess_user_id']))
	{
		//$username = $_SESSION["username"];
		$userid = $_SESSION['sess_user_id'];
		$query=$con->prepare("select count(*) from cart where userid = ? "); //check if user exists in database
		$query->bind_param('i',$userid); //bind parameter
		$query->execute(); //execute query
		$query->bind_result($count);
		$query->fetch(); //fetch query
		$query->close(); //close query
		$_SESSION["noofcartitem"] = $count;
	}
	else
	{
		$ip = getIp();

		$query=$con->prepare("select count(*) from cart where ipaddr = ? "); //check if user exists in database
		$query->bind_param('s',$ip); //bind parameter
		$query->execute(); //execute query
		$query->bind_result($count);
		$query->fetch(); //fetch query
		$query->close(); //close query
		$_SESSION["noofcartitem"] = $count;

	}
}

function getProfile()
{

	
	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}
	$key = md5('SingOnStorezSing');
	if(isset($_SESSION['sess_user_id']))
	{
		$username = $_SESSION["username"];

		$query=$con->prepare("select firstname, lastname, phone, email from users where username = ?"); //select from database
		$query->bind_param('s',$username);
		$query->execute();
		$query->bind_result($firstname, $lastname, $phone, $email); //bind result
		echo "<table align='center'";
		
		while($query->fetch()) //fetch query
		{
			echo "<tr><th>First Name</th>";
			echo "<td>".$firstname."</td>"; //echo data
			echo "<tr><th>Last Name</th>";
			echo "<td>".$lastname."</td>";
			echo "<tr><th>Phone</th>";
			echo "<td>".$phone."</td>";
			echo "<tr><th>Email</th>";
			echo "<td>".decrypt($email, $key)."</td></tr>";
			echo "<tr><th></th>";
			echo "<td><a href='ProfileEdit.php?firstname=".$firstname."&lastname=".$lastname."&phone=".$phone."&email=".$email."'>edit</a></td>"; //edit button
			echo "</tr>";
		}
		echo "</table>";
	}
}

function profile()
{
	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}
	
	$key = md5('SingOnStorezSing');
	if(isset($_SESSION['sess_user_id']))
	{
		$username = $_SESSION["username"];
		$query=$con->prepare("select firstname, lastname, phone, email from users where username = ?"); //select from database
		$query->bind_param('s',$username);
		$query->execute();
		$query->bind_result($firstname, $lastname, $phone, $email); //bind result
		$query->fetch();
		$query->close();
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['phone'] = $phone;
		$_SESSION['email'] = decrypt($email, $key);
		
	}
	else
	{
		header('location:index.php');
		exit;
	}
} 

function getToken()
{
	if(!isset($_SESSION['usertoken']))
	{
		$_SESSION['usertoken'] = base64_encode(openssl_random_pseudo_bytes(32));
	}
}

function checkToken($token)
{
	if($token != $_SESSION['usertoken'])
	{
		destroyToken();
		header('location:404.php');
		exit;
	}
}

function getTokenField()
{
	return '<input type="hidden" name="token" value="'.$_SESSION['usertoken'].'"/>';
}

function destroyToken()
{
	unset($_SESSION['usertoken']);
}

function getPayments()
{

	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}
	
	if(isset($_SESSION['sess_user_id']))
	{
		$userid = $_SESSION['sess_user_id'];
		//$username = $_SESSION["username"];
		$query = $con->prepare("SELECT products.name AS itemname, orders.quantity, amountpaid, datetime FROM orders JOIN products ON products.id = orders.productid where userid = ? UNION SELECT package.name AS itemname, orders.quantity, amountpaid, datetime FROM orders JOIN package on package.id = orders.packageid where userid = ?"); //select from database where username will get the value from $username
		$query->bind_param('ii', $userid, $userid); //bind the parameters
		$query->execute(); //execute query
		$query->bind_result($itemname, $quantity, $price, $datetime);
		echo "<table class='table-responsive table-hover table-bordered table-striped table-condensed' data-compression='5' data-min='10' data-max='25' data-width='100%' data-height='100%' data-adjust-parents='true' data-styled='true' cellpadding='0' cellspacing='0' align='center'>";
		echo "<tr>";
		echo "<th>S/N</th>";
		echo "<th>Item Name</th>";
		echo "<th>Quantity</th>";
		echo "<th>Price($)</th>";
		echo "<th>Date of Purchase</th>";
		echo "</tr>";
		$i = 1;
		while ($query->fetch())
		{
										
			echo "<tr>"; //echo table row
			echo "<td>$i</td>"; //echo data
			echo "<td>$itemname</td>";
			echo "<td>$quantity</td>";
			echo "<td>$$price</td>";
			echo "<td>$datetime</td>";
			echo "</tr>";
			$i++;
		}
		echo "</table>";							
	}
	$query->close();
}


function getOnlineusers()
{
	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}
	
	$query=$con->prepare("select count(*) from onlineusers"); //check if user exists in database
	$query->execute(); //execute query
	$query->bind_result($count);
	$query->fetch(); //fetch query
	$query->close(); //close query
	$_SESSION["onlineusers"] = $count;
	
}

function getPaymenthistory()
{

	$con = mysqli_connect ( "localhost", "onesfswb_root", "nR5zNLaz" , "onesfswb_mpdatabase"); //connect to database
	if (!$con)
	{
		die ('Could not connect' . mysqli_connect_error()); //return error that connection failed
	}
	
	if(isset($_SESSION['adminid']))
	{
		//$username = $_SESSION["username"];
		$query = $con->prepare("SELECT userid, products.name AS itemname, payments.quantity, amount, trxid, datetime FROM payments JOIN products ON products.id = payments.productid UNION SELECT userid, package.name AS itemname, payments.quantity, amount, trxid, datetime FROM payments JOIN package on package.id = payments.packageid"); //select from database where username will get the value from $username
		$query->execute(); //execute query
		$query->bind_result($userid, $itemname, $quantity, $price, $trxid, $datetime);
		echo "<table class='table-responsive table-hover table-bordered table-striped table-condensed' data-compression='5' data-min='10' data-max='25' data-width='100%' data-height='100%' data-adjust-parents='true' data-styled='true' cellpadding='0' cellspacing='0' align='center'>";
		echo "<tr>";
		echo "<th>S/N</th>";
		echo "<th>Userid</th>";
		echo "<th>Item Name</th>";
		echo "<th>Quantity</th>";
		echo "<th>Price($)</th>";
		echo "<th>Transaction Id</th>";
		echo "<th>Date of Purchase</th>";
		echo "</tr>";
		$i = 1;
		while ($query->fetch())
		{
										
			echo "<tr>"; //echo table row
			echo "<td>$i</td>"; //echo data
			echo "<td>$userid</td>";
			echo "<td>$itemname</td>";
			echo "<td>$quantity</td>";
			echo "<td>$$price</td>";
			echo "<td>$trxid</td>";
			echo "<td>$datetime</td>";
			echo "</tr>";
			$i++;
		}
		echo "</table>";							
	}
}

function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
}

?>