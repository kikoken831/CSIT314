<?php

					if (isset($_GET['cat'], $_GET['pax']))
					{
						$cat = $_GET["cat"];
						$pax = $_GET["pax"];
						
						if (ctype_digit($cat) && ctype_digit($pax))
						{
							$query=$con->prepare("SELECT id FROM package WHERE package = ? AND pax = ?"); //check if user exists in database
							$query->bind_param('ii', $cat, $pax); //bind parameter
							$query->execute(); //execute query
							$query->bind_result($packageid);
							$query->fetch(); //fetch query
							$query->close(); //close query
								
							if (isset($_SESSION['sess_user_id']))
							{

								$userid = $_SESSION['sess_user_id'];
								$query=$con->prepare("select count(*) from cart where userid = ? and packageid = ?"); //check if user exists in database
								$query->bind_param('ii',$userid, $packageid); //bind parameter
								$query->execute(); //execute query
								$query->bind_result($count);
								$query->fetch(); //fetch query
								$query->close(); //close query
								if($count==0)
								{
									$quantity = 1;
									$price = $_SESSION['pp'];
									$query = $con->prepare("insert into cart (userid, packageid, quantity, pprice) values(?,?,?,?)");   //prepare sql query
									//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
									$query->bind_param('iiid', $userid, $packageid, $quantity, $price);   //i-integer, d-double, s-string, b-blob
									if ($query->execute())
									{
										?>
										<script type="text/javascript">
													alert("Added to cart successfully!");
													window.location.href = "packages.php"; 
													</script>
										<?php
									}
									else
									{
										?>
										<script type="text/javascript">
													alert("Please try again!");
													window.location.href = "packages.php"; 
													</script>
										<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
													alert("You have added this package already. Only 1 package can be added.");
													window.location.href = "cart.php"; 
													</script>
										<?php
								}
								
							}
							else
							{
								$ip = getIp();
								$query=$con->prepare("select count(*) from cart where ipaddr = ? and packageid = ?"); //check if user exists in database
								$query->bind_param('si',$ip, $packageid); //bind parameter
								$query->execute(); //execute query
								$query->bind_result($count);
								$query->fetch(); //fetch query
								$query->close(); //close query
								if($count==0)
								{
									$quantity = 1;
									$price = $_SESSION['pp'];
									$query = $con->prepare("insert into cart (ipaddr, packageid, quantity, pprice) values(?,?,?,?)");   //prepare sql query
									//Bind variables for the parameter markers in the SQL statement that was passed to prepare().
									$query->bind_param('siid', $ip, $packageid, $quantity, $price);   //i-integer, d-double, s-string, b-blob
									if ($query->execute())
									{
										?>
										<script type="text/javascript">
													alert("Added to cart successfully!");
													window.location.href = "packages.php"; 
													</script>
										<?php
									}
									else
									{
										?>
										<script type="text/javascript">
													alert("Please try again!");
													window.location.href = "packages.php"; 
													</script>
										<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
													alert("You have added this package already. Only 1 package can be added.");
													window.location.href = "cart.php"; 
													</script>
										<?php
								}
							}
							
						}
						else
						{
							header('location:404.php');
							exit;
						}
					}
				?>

<?php
				
				if ( isset ($_POST["go"]))
				{
					$token = mysqli_real_escape_string($con,$_POST["token"]);
					checkToken($token);
					destroyToken();
					$category = mysqli_real_escape_string($con,$_POST["category"]); //escapes special characters in a string
					$category = strip_tag($category); //function that take out unneccessary characters in a string
					$pax = mysqli_real_escape_string($con,$_POST["pax"]); //escapes special characters in a string
					$pax = strip_tag($pax); //function that take out unneccessary characters in a string
					
					if (!empty($category) && !empty($pax))
					{
						if ($category == 1) //meat is option 1
						{
								//$query->close();
								$query = $con->prepare("SELECT multiplier from pax WHERE id = ?"); 
								$query->bind_param('i', $pax); //bind the parameters
								$query->execute(); //execute query
								$query->bind_result($multiplier);
								$query->fetch();
								$query->close();
								
								$query1 = $con->prepare("select name, image, price, quantity from products inner join categories on products.category = categories.id where categories.id= ?"); 
								$query1->bind_param('i', $category); //bind the parameters
								$query1->execute(); //execute query
								$query1->bind_result($name, $image, $price, $quantity);

								echo "<table class='table-responsive table-hover table-bordered table-striped table-condensed' data-compression='5' data-min='10' data-max='25' data-width='100%' data-height='100%' data-adjust-parents='true' data-styled='true' cellpadding='0' cellspacing='0' align='center'>";
								echo "<tr>";
								echo "<th>S/No</th>";
								echo "<th>Item Name</th>";
								echo "<th>Image</th>";
								echo "<th>No.of Packets</th>";
								echo "<th>Qty/Packet</th>";
								echo "<th>Total Qty</th>";
								echo "</tr>";
								$i = 1;
								while ($query1->fetch())
								{
									$totalprice += ($price*$multiplier);
									$totalqty = $multiplier * $quantity;
									echo "<tr>"; //echo table row
									echo "<td>$i</td>"; //echo data
									//$itemid='<input type="hidden" name="id[]" value="'.$id.'" />';
									//echo $itemid;
									echo "<td>$name</td>"; //echo data
									echo "<td><img src='productimages/$image' width='100' height='100' /></td>";
									echo "<td>$multiplier</td>";
									echo "<td>$quantity</td>";
									//echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."'></td>";
									//echo "<td>$$price</td>";
									echo "<td>$totalqty</td>";
									echo "</tr>";
									$i++;
									
								}
								
								echo "</table>"; //echo table
								$_SESSION['pp'] = $totalprice;
								echo "<b><p align = 'center' class='subtotal'>Total Price: $$totalprice</p></b>";
								echo '<input type="hidden" name="category" value="'.$category.'" />';
								echo '<input type="hidden" name="pax" value="'.$pax.'" />';
								//echo "<p><input type='submit' name='addtocart' value='Add To Cart'></p></br>";
								echo "<p><a href='packages.php?cat=$category&pax=$pax'><button>Add to Cart</button></a></p>";
								
					
								
							
						}
						elseif($category == 2)
						{	
							//$query->close();
							$query = $con->prepare("SELECT multiplier from pax WHERE id = ?"); 
							$query->bind_param('i', $pax); //bind the parameters
							$query->execute(); //execute query
							$query->bind_result($multiplier);
							$query->fetch();
							$query->close();
								
							$query1 = $con->prepare("select name, image, price, quantity from products inner join categories on products.category = categories.id where categories.id= ? or constant=1"); 
							$query1->bind_param('i', $category); //bind the parameters
							$query1->execute(); //execute query
							$query1->bind_result($name, $image, $price, $quantity);
							echo "<table class='table-responsive table-hover table-bordered table-striped table-condensed' data-compression='5' data-min='10' data-max='25' data-width='100%' data-height='100%' data-adjust-parents='true' data-styled='true' cellpadding='0' cellspacing='0' align='center'>";
							echo "<tr>";
							echo "<th>S/No</th>";
							echo "<th>Item Name</th>";
							echo "<th>Image</th>";
							echo "<th>No.of Packets</th>";
							echo "<th>Qty/Packet</th>";
							echo "<th>Total Qty</th>";
							echo "</tr>";
							$i = 1;
							while ($query1->fetch())
							{
								$totalprice += ($price*$multiplier);
								$totalqty = $multiplier * $quantity;
								echo "<tr>"; //echo table row
								echo "<td>$i</td>"; //echo data
								//$itemid='<input type="hidden" name="id[]" value="'.$id.'" />';
								//echo $itemid;
								
								echo "<td>$name</td>"; //echo data
								echo "<td><img src='productimages/$image' width='100' height='100' /></td>";
								echo "<td>$multiplier</td>";
								echo "<td>$quantity</td>";
								//echo "<td><input type='number' name='quantity[]' min='1' max='20' value='".$quantity."'></td>";
								//echo "<td>$$price</td>";
								echo "<td>$totalqty</td>";
								echo "</tr>";
								$i++;
									
							}
							$query1->close();
							$_SESSION['pp'] = $totalprice;
							echo "</table>"; //echo table
							echo "<b><p align = 'center' class='subtotal'>Total Price: $$totalprice</p></b>";
							echo '<input type="hidden" name="category" value="'.$category.'" />';
							echo '<input type="hidden" name="pax" value="'.$pax.'" />';
							//echo "<p><input type='submit' name='addtocart' value='Add To Cart'></p></br>";
							echo "<p><a href='packages.php?cat=$category&pax=$pax'><button>Add to Cart</button></a></p>";
							
						}
					}
					else
					{
						?>
							<script type="text/javascript">
							alert("Please select both of the options");
							window.location.href = "packages.php"; 
							</script>
						<?php
					}
				}
				?>