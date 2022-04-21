
<!DOCTYPE HTML>
<?php 
ob_start();
session_start();
include ("include/function.php");
include ("include/connect.php");
if(!isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location:index.php");
	exit;
}
include ("include/sessiontimeout.php");
?>
<html>
<head>
<title>One-Stop BBQ</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/control.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!--Google Fonts-->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>

	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
<!-- //end-smoth-scrolling -->
	<script type="text/javascript">
	  $(document).ready(function() {
		$('table.responsive').responsiveTables();
	  });
	</script>
	
 <script type = "text/javascript">
function show_hide(show, hide)
{
document.getElementById(show).style.display="block";
document.getElementById(hide).style.display="none";
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
    $("#parent1").css("display","none");
        $(".aboveage1").click(function(){
        if ($('input[name=age1]:checked').val() == "No" ) {
            $("#parent1").slideDown("fast"); //Slide Down Effect
        } else {
            $("#parent1").slideUp("fast");  //Slide Up Effect
        }
     });
});
</script> 
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=289011751125169";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--header start here-->
<div class="header">
   <div class="container">
        <div class="header-main">
			 <div class="logo">
			   <a href="index.php"><img src="images/logo3.png" alt="One-stopbbq logo"></a>
			 </div>
			 
			<div class="logintext" align="right">
				   <?php 
				   
				   if(!isset($_SESSION['sess_user_id']))
				   {
				   	echo "<a href='loginpage.php'>Login</a>";
				   }
				   
				   else{
					echo "<a href='logout.php'>Logout</a>";
				   }
				  
				   ?>
			</div>
			<div class="cartheader" align="right">
				 	<?php 
				 		getCart();
				 		echo "<a href='cart.php'>Cart:</a>" . $_SESSION["noofcartitem"];	
				 	?>
			</div>	
			<div class="welcometext" align="right">
				   <?php 
				   
				   if(!isset($_SESSION['sess_user_id']))
				   {
				   	echo "Welcome Guest!"."<br />";
				   }
				   
				   else
				   {
					echo "<a href='profile.php' class='welcometexthover'>Welcome " . $_SESSION["username"] . "</a>";
				   }
				  
				   ?>

			</div>
				<?php
					echo "</br>";
					echo "</br>";
				   ?>
			<div id="search" align="right">
				<form method="post" action="results.php" enctype="multipart/form-data">
			 		<input type="search" name="searchquery" placeholder="Search any products!" />
			 		<input type="submit" name="search" value="Search" />
					 	
				</form>
			</div>
				<?php
					echo "</br>";
					echo "</br>";
				   ?>
            <div class="top-nav">
            	<span class="menu"> <img src="images/icon.png" alt=""/></span>
				<ul class="nav nav-pills nav-justified res">
					<li><a href="index.php"><i class="glyphicon glyphicon-home"> </i>Home</a></li>
					<li><a href="about.php"><i class="glyphicon glyphicon-star"> </i>About</a></li>
					<li><a href="alacarte.php"><i  class="glyphicon glyphicon-thumbs-up"> </i>Alacarte</a></li>
					<li><a href="packages.php"><i class="glyphicon glyphicon-list-alt"> </i>Packages</a></li>
					<li><a href="contact.php"><i class="glyphicon glyphicon-envelope"> </i>Contact</a></li>
				</ul>
				</ul>
				<!-- script-for-menu -->
							 <script>
							   $( "span.menu" ).click(function() {
								 $( "ul.res" ).slideToggle( 300, function() {
								 // Animation complete.
								  });
								 });
							</script>
			<!-- /script-for-menu -->
			 </div>	
     <div class="clearfix"> </div>
   </div>	
 </div>
</div>
<!--header end here-->
<!--banner start here-->
<div class="banner">
	<div class="container">
		<div class="banner-main">
		<?php getToken(); ?>
		<form action="delivery.php" method="post" id="register-form" autocomplete="off" align="center">
				
		<h2>Delivery Information</h2>

		<div id="form-content">
    		<fieldset>

			<div>
				<input type="radio" name="deliver" value="home" class="deliverto" /> Deliver to Home Address
				<br/>
				<input type="radio" name="deliver" value="chalet" class="deliverto" /> Deliver to Chalets/Parks
			</div>
			

			<div id="chalet">
				<div class="fieldgroup">
					<label for="chaletpark">Chalet/Park: </label>
					<select name="chaletpark">
					  <option value="" disabled="disabled">Select a chalet/park</option>
					  <option value="ECP">East Coast Park</option>
					  <option value="PRP">Pasir Ris Park</option>
					  <option value="CB">Changi Beach</option>
					  <option value="SP">Sembawang Park</option>
					  <option value="PP">Punggol Park</option>
					  <option value="LP">Labrador Park</option>
					  <option value="ACC">Aranda Country Club</option>
					  <option value="ALC">Aloha Loyang Chalet</option>
					  <option value="DR">D'Resort</option>
					</select>
				</div>
				<div class="fieldgroup">
					<label for="pitno">Pit No: </label>
					<input type="number" id="pitno" min="1" max="30" name="pitno"/>
				</div>
				<div class="fieldgroup">
					<label for="date">Delivery Date: </label>
					<input type="date" min="<?php echo date("Y/m/d"); ?>"id="date" name="date"/>
					<span>We need at least 3 days to process your order</span>
				</div>
				<div class="fieldgroup">
					<label for="time">Delivery Time: </label>
					<input type="time" id="time" name="time"/>
				</div>
			</div>

			<div id="home">
				<div class="fieldgroup">
					<label for="postal">Postal Code: </label>
					<input type="number" id="postal" min="000000" max="999999"name="postal"/>
				</div>
				<div class="fieldgroup">
					<label for="street">Street: </label>
					<textarea name="street" rows="3" cols="25"></textarea>
				</div>
				<div class="fieldgroup">
					<label for="block">Block No: </label>
					<input type="text" id="block" name="block"/>
				</div>
				<div class="fieldgroup">
					<label for="unit">Unit No: </label>
					#<input type="text" id="unit" name="unit"/>
				</div>
				<div class="fieldgroup">
					<label for="date2">Delivery Date: </label>
					<input type="date" min="<?php echo date("Y-m-d"); ?>" id="date2" name="date2"/>
					<span>We need at least 3 days to process your order</span>
				</div>
				<div class="fieldgroup">
					<label for="time2">Delivery Time: </label>
					<input type="time" id="time2" name="time2"/>
				</div>
			</div>
			<?php echo getTokenField(); ?>
			<input type="submit" name="submit" value="Submit" class="submitbtn" />
			</fieldset>
		</div>
	</form>

				<?php
					
					if(isset($_POST['submit']))
					{
						if(isset($_SESSION['sess_user_id']))
						{
							$token = mysqli_real_escape_string($con,$_POST["token"]);
							checkToken($token);
							destroyToken();

							if ($_POST['deliver'] == "chalet")
							{
								$chaletpark = mysqli_real_escape_string($con,$_POST["chaletpark"]); //escapes special characters in a string
								$chaletpark = strip_tag($chaletpark); //function that take out unneccessary characters in a string
								$pitno = mysqli_real_escape_string($con,$_POST["pitno"]); //escapes special characters in a string
								$pitno = strip_tag($pitno); //function that take out unneccessary characters in a string
								//$date = mysqli_real_escape_string($con,$_POST["date"]); //escapes special characters in a string
								//$date = strip_tag($date); //function that take out unneccessary characters in a string
								//$time = mysqli_real_escape_string($con,$_POST["time"]); //escapes special characters in a string
								//$time = strip_tag($time); //function that take out unneccessary characters in a string
								//$date = $_POST['date'];
								
								$time = $_POST["time"];
								$time  = date("g:i a", strtotime($time));

								$date = $_POST['date'];
								$today=date('Y-m-d');
								$compareddate = date('Y-m-d', strtotime($today. ' + 3 days'));

								if( !empty($chaletpark) && !empty($pitno) && !empty($date) && !empty($time))
								{
									if(ctype_alpha($chaletpark))
									{
										if (ctype_digit($pitno))
										{
											if ($date >= $compareddate)
											{
												$date = date('d/m/Y', strtotime($_POST['date']));
												if (checkvaliddate($date))
												{
													if (checkvalidtime($time))
													{
														$userid = $_SESSION['sess_user_id'];
														$query = $con->prepare("insert into deliverychalet (userid, cpname, pitno, deliverydate, deliverytime) values(?,?,?,?,?)");   //prepare sql query
																//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
														$query->bind_param('isiss', $userid, $chaletpark, $pitno, $date, $time);   //i-integer, d-double, s-string, b-blob
														if ($query->execute())
														{
															$_SESSION['otp'] = 1;
															header("location:otp.php");
															exit;
														}
														else
														{
															?>
															<script type="text/javascript">
															alert("Please try again!");
															window.location.href = "delivery.php"; 
															</script>
															<?php
														}
													}
													else
													{
														?>
														<script type="text/javascript">
														alert("Time is incorrect");
														window.location.href = "delivery.php"; 
														</script>
														<?php
													}
												}
												else
												{
													?>
													<script type="text/javascript">
													alert("Date is incorrect");
													window.location.href = "delivery.php"; 
													</script>
													<?php
													
												}
											}
											else
											{
												?>
														<script type="text/javascript">
														alert("We need at least 3 days to process your order");
														window.location.href = "delivery.php"; 
														</script>
													<?php
											}
										}
										else
										{
											?>
											<script type="text/javascript">
											alert("Pit No should consists of alphabets only");
											window.location.href = "delivery.php"; 
											</script>
											<?php
										}
										
									}
									else
									{
										?>
										<script type="text/javascript">
										alert("Chalet/Park should consists of alphabets only");
										window.location.href = "delivery.php"; 
										</script>
										<?php
									}
									
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Please fill in all the blanks");
										window.location.href = "delivery.php"; 
										</script>
									<?php
					
								}
							}
							elseif ($_POST['deliver'] == "home")
							{
								$postal = mysqli_real_escape_string($con,$_POST["postal"]); //escapes special characters in a string
								$postal = strip_tag($postal); //function that take out unneccessary characters in a string
								$street = mysqli_real_escape_string($con,$_POST["street"]); //escapes special characters in a string
								$street = strip_tag($street); //function that take out unneccessary characters in a string
								$block = mysqli_real_escape_string($con,$_POST["block"]); //escapes special characters in a string
								$block = strip_tag($block); //function that take out unneccessary characters in a string
								$unit = mysqli_real_escape_string($con,$_POST["unit"]); //escapes special characters in a string
								$unit = strip_tag($unit); //function that take out unneccessary characters in a string

								$time = $_POST["time2"];
								$time  = date("g:i a", strtotime($time));

								$date = $_POST['date2'];
								$today=date('Y-m-d');
								$compareddate = date('Y-m-d', strtotime($today. ' + 3 days'));

								if( !empty($postal) && !empty($street) && !empty($block) && !empty($unit) && !empty($time) && !empty($date))
								{
									if(ctype_digit($postal) && checkpostal($postal))
									{
										if(checkaddress($street))
										{
											if(checkblock($block))
											{
												if(checkunit($unit))
												{
													if ($date >= $compareddate)
													{
														$date = date('d/m/Y', strtotime($_POST['date2']));
														if (checkvaliddate($date))
														{
															if (checkvalidtime($time))
															{
																$userid = $_SESSION['sess_user_id'];
																$query = $con->prepare("insert into deliveryhome (userid, postal, street, block, unit, deliverydate, deliverytime) values(?,?,?,?,?,?,?)");   //prepare sql query
																//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
																$query->bind_param('iisssss', $userid, $postal, $street, $block, $unit, $date, $time);   //i-integer, d-double, s-string, b-blob
																if ($query->execute())
																{
																	$_SESSION['otp'] = 1;
																	header("location:otp.php");
																	exit;
																}
																else
																{
																	?>
																	<script type="text/javascript">
																	alert("Please try again!");
																	window.location.href = "delivery.php"; 
																	</script>
																	<?php
																}
															}
															else
															{
																?>
																<script type="text/javascript">
																alert("Time is incorrect");
																window.location.href = "delivery.php"; 
																</script>
																<?php
															}
														}
														else
														{
															?>
															<script type="text/javascript">
															alert("Date is incorrect");
															window.location.href = "delivery.php"; 
															</script>
															<?php
															
														}
													}
													else
													{
														?>
																<script type="text/javascript">
																alert("We need at least 3 days to process your order");
																window.location.href = "delivery.php"; 
																</script>
															<?php
													}
												}
												else
												{
													?>
													<script type="text/javascript">
													alert("Invalid unit");
													window.location.href = "delivery.php"; 
													</script>
													<?php
												}
											}
											else
											{
												?>
												<script type="text/javascript">
												alert("Invalid block");
												window.location.href = "delivery.php"; 
												</script>
												<?php
											}
										}
										else
										{
											?>
											<script type="text/javascript">
											alert("Invalid street");
											window.location.href = "delivery.php"; 
											</script>
											<?php
										}
									}
									else
									{
										?>
										<script type="text/javascript">
										alert("Invalid Postal Code");
										window.location.href = "delivery.php"; 
										</script>
										<?php
									}
									
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Please fill in all the blanks");
										window.location.href = "delivery.php"; 
										</script>
									<?php
								}

							}
							else
							{
								?>
										<script type="text/javascript">
										alert("Please choose either one of the options.");
										window.location.href = "delivery.php"; 
										</script>
									<?php
							}
						}
						else
						{
							header("location:index.php");
							exit;
						}
					
					}
					
					
					
					?>	
					
		</div>
	</div>
</div>
<!--banner end here-->

<!--footer start here-->
<?php
include("footer.php");

?>
</html>