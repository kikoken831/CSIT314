<?php
  session_start();
  if(isset($_GET['action']) == "add"){
    $id = $_GET['id'];

    if(isset($_SESSION['cart'][$id])){
      $previous=$_SESSION['cart'][$id]['qty'];
      $_SESSION['cart'][$id] = array("pid"=>$id, "qty"=>$previous+$_POST['quantity']);
    }
    else{
      $_SESSION['cart'][$id] = array("pid"=>$id, "qty"=>$_POST['quantity']);
    }
    header("location:home.php");
  }

  if(isset($_GET['remove'])){
    $id = intval($_GET['remove']);
    
    unset($_SESSION['cart'][$id]);
  }

  if(isset($_GET['clear'])){
    unset($_SESSION['cart']);
  }

 
  

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    #totalitems {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    
    }
    .badge {
      padding-left: 9px;
      padding-right: 9px;
      -webkit-border-radius: 9px;
      -moz-border-radius: 9px;
      border-radius: 9px;
      margin-left: -10px;
    }

    .label-warning[href],
    .badge-warning[href] {
      background-color: #c67605;
    }

    .container {
      background-color: #263d6f;
      width: 25%;
      height: 60px;
      border-radius: 20px!important;
      position: fixed;
      top: 0px;
      right: 0px;
      z-index: 3;
      padding: 5px;
      padding-top: 12px;
      margin: 25px;
  }

  .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 0.3rem;
    outline: 0;
    width: 120%;
  }

  input[type=number]{
    width: 50px;
  } 
  

      </style>
    <title>Home</title>
  </head>
  <body>
		<?php
			$servername="localhost";
			$username="root";
			$serverpw="";
			$dbname="restaurant";
			$dbtable="ITEM";

			$conn = new mysqli($servername, $username, $serverpw, $dbname);
			if ($conn->connect_error) { die("connection failed"); }

			$sql = "select * from $dbtable where visible = true";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				while ($row=$result->fetch_assoc())
					{
						$menuArr[] = array('item id' => $row["ITEM ID"],'item name' => $row["ITEM NAME"], 'price' => $row["PRICE"], 'imageurl' => $row["IMAGEURL"], 'category' => $row["CATEGORY"] );
					}
			}

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      if(isset($_POST['update_qty']))
      {
        foreach($_SESSION['cart'] as $key => $value)
        {
          $query = mysqli_query($conn, "select * from `item` where `item id` = $key");
      
          foreach($query as $a)
          {
            if($a["ITEM ID"]==$_POST['item_id'])
            {
              $id = $a["ITEM ID"];
              $_SESSION['cart'][$id] = array("pid"=>$id, "qty"=>$_POST['quantity']);
              //header("location:home.php");
            }
          }
        }
      }
    }

    $total = 0;
    if(isset($_SESSION['cart']))
    {
      foreach($_SESSION['cart'] as $key => $value)
      {
        $query = mysqli_query($conn, "select * from `item` where `item id` = $key");
    
        foreach($query as $a)
        {
            $total += $value['qty']*$a["PRICE"];
        }
      }
    }

		?>
    <div class="bg-dark p-3">
      <div class="row mx-0 py-3 bg-light rounded-3">
        <div class="">
          Order #88 <small class="text-muted"><span id='date-time'></small>
          <button onclick="window.location.href='transactionHistory.php'" class="btn btn-outline-danger my-2 my-lg-0" style="width:20%; margin:10px;" type="submit">Transaction History</button>
          <button onclick="window.location.href='login.php'" class="btn btn-outline-danger my-2 my-lg-0" style="width:10%; margin:10px;" type="submit">Log Out</button>

          <div class="card mb-3 rounded-3">
            <div class="btn btn-primary container" onclick="activeCartModalHandler()">
                <div style="width: 50%;float: left;"> 
                  <i class="fa" style="font-size:30px">&#xf07a;</i>
                  <span class='badge badge-warning' id='totalitems'><?php if(isset($_SESSION['cart'])){echo array_sum(array_column($_SESSION['cart'], 'qty')); }else{echo "0";}?></span>
                </div>
                <div style="margin-left: 50%;"> 
                  <li class="d-flex justify-content-between align-items-center"> <span id="totalcost" class="card-text">$<?php echo number_format($total, 2);?></span></li>
                </div>
            </div>
          </a>

            <div class="card-body">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active rounded-pill" id="pills-entree-tab" data-bs-toggle="pill" data-bs-target="#pills-entree" type="button" role="tab" aria-controls="pills-entree" aria-selected="true">Entree</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link rounded-pill" id="pills-meal-tab" data-bs-toggle="pill" data-bs-target="#pills-meal" type="button" role="tab" aria-controls="pills-meal" aria-selected="false">Meals</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link rounded-pill" id="pill-drink-tab" data-bs-toggle="pill" data-bs-target="#pills-drink" type="button" role="tab" aria-controls="pills-dirnk" aria-selected="false">Drinks</button>
            </li>
          </ul>
        </div>
        </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-entree" role="tabpanel" aria-labelledby="pills-entree-tab">
                <div class="row row-cols-1 row-cols-md-4 g-1 card-deck">
					<?php
						foreach($menuArr as $key => $value) {
							if ($value['category'] == 'Entree') {?>
							<form action="home.php?action=add&id=<?php echo $value['item id']?>" method="post">
              <div class="col">
              <div class="card">

									<img src="<?php echo $value['imageurl']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['item name']?></h6>
										<h6 class="fw-bold">$<?php echo $value['price']?></h6>
                    <input type="button" class="border rounded bg-white sign" onclick="decrementValue('<?php echo $value['item id']?>')" value="-" />
                    <input type="text" class="border rounded bg-white sign" name="quantity" value="1" maxlength="2" max="10" size="1" id="<?php echo $value['item id']?>" />
                    <input type="button" class="border rounded bg-white sign" onclick="incrementValue('<?php echo $value['item id']?>')" value="+" /> 
                    <input type="submit" value="Add to cart" name="btncart" class="btn w-100 rounded my-2 border">
                  </div> 
								</div>
							</div>
              </form>
							<?php }
						}
					?> 
                </div>
            </div>
            <div class="tab-pane fade" id="pills-meal" role="tabpanel" aria-labelledby="pills-meal-tab">
                <div class="row row-cols-1 row-cols-md-4 g-1">
                    <?php
						foreach($menuArr as $key => $value) {
							if ($value['category'] == 'Meals') {?>
							<form action="home.php?action=add&id=<?php echo $value['item id']?>" method="post">
              <div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['item name']?>',<?php echo $value['price']?>,'<?php echo $value['imageurl']?>')">
									<img src="<?php echo $value['imageurl']?>" class="card-img-top" alt="...">
									<div class="card-body">
                  <h6 class="card-title"><?php echo $value['item name']?></h6>
										<h6 class="fw-bold">$<?php echo $value['price']?></h6>
                    <input type="button" class="border rounded bg-white sign" onclick="decrementValue('<?php echo $value['item id']?>')" value="-" />
                    <input type="text" class="border rounded bg-white sign" name="quantity" value="1" maxlength="2" max="10" size="1" id="<?php echo $value['item id']?>" />
                    <input type="button" class="border rounded bg-white sign" onclick="incrementValue('<?php echo $value['item id']?>')" value="+" /> 
                    <input type="submit" value="Add to cart" name="btncart" class="btn w-100 rounded my-2 border">
									</div>
								</div>
							</div>
              </form>
							<?php }
						}
					?> 
                </div>
            </div>
            <div class="tab-pane fade" id="pills-drink" role="tabpanel" aria-labelledby="pills-drink-tab">
                <div class="row row-cols-1 row-cols-md-4 g-1">
                    <?php
						foreach($menuArr as $key => $value) {
							if ($value['category'] == 'Drinks') {?>
							<form action="home.php?action=add&id=<?php echo $value['item id']?>" method="post">
              <div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['item name']?>',<?php echo $value['price']?>,'<?php echo $value['imageurl']?>')">
									<img src="<?php echo $value['imageurl']?>" class="card-img-top" alt="...">
									<div class="card-body">
                  <h6 class="card-title"><?php echo $value['item name']?></h6>
										<h6 class="fw-bold">$<?php echo $value['price']?></h6>
                    <input type="button" class="border rounded bg-white sign" onclick="decrementValue('<?php echo $value['item id']?>')" value="-" />
                    <input type="text" class="border rounded bg-white sign" name="quantity" value="1" maxlength="2" max="10" size="1" id="<?php echo $value['item id']?>" />
                    <input type="button" class="border rounded bg-white sign" onclick="incrementValue('<?php echo $value['item id']?>')" value="+" /> 
                    <input type="submit" value="Add to cart" name="btncart" class="btn w-100 rounded my-2 border">
									</div>
								</div>
							</div>
              </form>
							<?php }
						}
					?> 
                </div>
            </div>
          </div>    
      </div>
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title"> Cart Details </h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
          
          <div class="card-body">
                   <?php
                      if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
                        echo "<h5>Cart is empty</h5>";
                      }
                      else{
                  ?>
                  <h6 class="d-flex justify-content-between align-items-center"><span>Cart</span><a class="btn btn-sm btn-danger rounded-pill" href='?clear'>Clear</a></h6>
                  <hr>
                  <ul class="list-unstyled">
                    <table class="table">
                      <thread>
                        <tr>
                          <th>Image</th>
                          <th>Item</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Amount</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>
                      </thread>
                      <tbody>
                      <?php
       
                      foreach($_SESSION['cart'] as $key => $value){
                        $query = mysqli_query($conn, "select * from `item` where `item id` = $key");
                        $product_qty = $value["qty"];


                        foreach($query as $a){
                          echo "<tr>
                            <td><img src='".$a["IMAGEURL"]."' width=\"100\" height=\"100\"/></td>
                            <td>".$a["ITEM NAME"]."</td>
                            <td>$".$a["PRICE"]."</td>
                            <td><form action='home.php' method='POST'><input type='number' size='2' min='1' maxlength='2' name='quantity' value='$product_qty' />
                            <input type='hidden' name='item_id' value=".$a["ITEM ID"]."></td>
                            <td>$".$value['qty']*$a["PRICE"]."</td>
                            <td><button name='update_qty' class='btn btn-success btn-sm'>Update</button></form></td>
                            <td><a class='btn btn-danger btn-sm' href='?remove=".$key."'>Delete</a></td>
                            </tr>";
                        }
                      }
                      
                      
                      ?>
                        </tbody>
                      </table>
                        <li>
                          <h5>Total Amount: $<?php echo number_format($total, 2);?></h5>
                            <hr>
                            <button id="btn-checkout" type="button" onclick="checkOut()" class="btn btn-primary btn-success mr-auto ml-auto">Check Out</button>
                        </li>
                    </ul>
                    <?php

                      }

                    ?>
              
              
					<div class="modal-footer text-center"></div>
          </div>
				</div>
			</div>
		</div>

    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
        <div class="modal-header">
						<h3 class="modal-title"> Payment Details </h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
          <div class="card-body">
          <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>        
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>        
              <i class="fa fa-cc-discover" style="color:orange;"></i>                
            </div>     
            <br>   
          <div class="payment">
        <form id="form" method="post">
            <div class="form-group owner">
                <label for="owner">Full Name</label>
                <input type="text" class="form-control" id="fullname" placeholder="John Tan" onblur="validate()">
                <span id="fullname-result"></span>
            </div>
            <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" placeholder="123" onblur="validate()">
                <span id="cvv-result"></span>
            </div>
            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardnum" placeholder="1234-4567-1234-4567" onblur="validate()">
                <span id="cardnum-result"></span>
            </div>
            <br>
            <div class="form-group" id="expiration-date">
                <label>Expiration Date</label>
                <select>
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                    <option value="25"> 2025</option>
                    <option value="26"> 2026</option>
                    <option value="27"> 2027</option>
                    <option value="28"> 2028</option>
                </select>
            </div>
            <br>
            <div class="form-group" id="coupon-field">
                <label for="coupon">Promo Code</label>
                <input type="text" class="form-control" id="coupon" onblur="checkPromo()">
                <span id="coupon-result"></span>
            </div>
            <br>
            <div class="form-group" id="subtotal">
                <span style="float:left">Sub-Total: </span><span style="float:right">$<?php echo number_format($total, 2);?></span><br>
                <span style="float:left">Promo Code: </span><span style="float:right" id="discount">-</span><br>
                <span style="float:left">Grand Total: </span><span style="float:right"><input type="text" name="grandtotal" id="grandtotal" value="$<?php echo number_format($total, 2);?>" style="border:0 none; text-align:right" readonly></span><br>
            </div>
            <br>
            <div class="form-group" id="pay-now">
                <button type="submit" class="btn btn-default btn-success" name="order" id="confirm-purchase" disabled="disabled">Order</button>
            </div>
        </form>
        
        
        <?php
          $servername="localhost";
          $username="root";
          $serverpw="";
          $dbname="restaurant";
          $dbtable="transaction";

          $conn = new mysqli($servername, $username, $serverpw, $dbname);
          if ($conn->connect_error) { die("connection failed"); }
          //print_r($menuArr); //test array set
        ?>
         <?php
             if (isset ($_POST["order"])){

                $couponid = $_SESSION['couponid'];        
                $tableid = $_SESSION['tableid'];
                $customerid = $_SESSION['cusID'];

                $grandtotal = $_POST["grandtotal"];
                $grandtotal = floatval(ltrim($grandtotal, '$'));

                $query=$conn->prepare("select max(`TRANSACTION ID`) from transaction where 1"); 
                $query->execute(); //execute query
                $query->bind_result($transactionid);
                $query->fetch(); //fetch query
                $query->close(); //close query
                
                if($transactionid !="")
                {
                  $transactionid = $transactionid + 1;

                  $query = $conn->prepare("INSERT INTO transaction (`TRANSACTION ID`, `TABLES ID`, `CUSTOMER ID`, `COUPON ID`, `STAFF ID`, `STATUS`, `DATETIME`, `TOTAL PRICE`) VALUES (?,?,?,?,NULL,'PENDING',now(),?)"); //insert into database
                  $query->bind_param('iiiid', $transactionid, $tableid, $customerid, $couponid, $grandtotal); //bind parameters
                        
                  if ($query->execute()) //execute query
                  {
                    foreach($_SESSION['cart'] as $key => $value){
                    $query = mysqli_query($conn, "select * from `item` where `item id` = $key");
                      
                      foreach($query as $a){
                      $product_qty = $value["qty"];
                      $itemid = $a["ITEM ID"];

                      $query = $conn->prepare("INSERT INTO cartitem (`TRANSACTION ID`, `ITEM ID`, `QUANTITY`) VALUES (?,?,?)"); //insert into database
                      $query->bind_param('iii', $transactionid, $itemid, $product_qty); //bind parameters
                      $query->execute();
                      }
                    }
                    unset($_SESSION['cart']);
                    ?>
                      <script type="text/javascript">
                      alert("Your order has been sent to the kitchen.");
                      window.location.href = "transactionHistory.php"; 
                      </script>
                    <?php
                  }
                  else
                  {
                    ?>
                       <script type="text/javascript">
                       alert("Please contact the support team.");
                      window.location.href = "home.php"; 
                      </script>
                    <?php
                  }
                }
                else
                {
                  ?>
                      <script type="text/javascript">
                      alert("Please contact the support team.");
                      window.location.href = "home.php"; 
                      </script>
                    <?php
                }
            }

          ?>


      </div>
        
          </div>
        <div class="modal-footer text-center"></div>

				</div>
			</div>
		</div>
    <script>
        
        function activeCartModalHandler()
        {
          $('#exampleModalCenter').modal('show');
        }

        function incrementValue(itemname)
        {
            var value = parseInt(document.getElementById(itemname).value, 10);
            value = isNaN(value) ? 0 : value;
            if(value<10){
                value++;
                    document.getElementById(itemname).value = value;
            }
        }
        function decrementValue(itemid)
        {
            var value = parseInt(document.getElementById(itemid).value, 10);
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                    document.getElementById(itemid).value = value;
            }

        }

        function checkOut()
        {
          $('#exampleModalCenter').modal('hide');
          $('#paymentModal').modal('show');
        }

        function validate(){
          validFullName = checkFullName($("#fullname"));
          validCVV = checkCVV($("#cvv"));
          validCardNum = checkCardNum($("#cardnum"));


          if(validFullName && validCVV && validCardNum) {
            $("#confirm-purchase").attr("disabled",false);
          }
          else{
            $("#confirm-purchase").attr("disabled",true);
          }
        }

        function checkFullName(obj) {
          var fullname_regex = /^[A-Za-z.-]+(\s*[A-Za-z.-]+)*$/;
          result = fullname_regex.test($(obj).val());
          
          if(!result) {
            $(obj).css('border-color', '#FB3A3A');
            $("#fullname-result").html("It should only contain letters");
            return false;
          }
          else
          {
            $("#fullname-result").html('');
            $('#fullname').css('border-color', '');
            return true;
          }
        }

        function checkCVV(obj) {
         var cvv_regex = /^\d{3}$/;
         result = cvv_regex.test($(obj).val());
         
         if(!result) {
           $(obj).css('border-color', '#FB3A3A');
           $("#cvv-result").html("CVV should be 3 digits");
           return false;
         }
         else
         {
           $("#cvv-result").html('');
           $('#cvv').css('border-color', '');
           return true;
         }
       }

       function checkCardNum(obj) {
         var cardnum_regex = /\b\d{4}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}\b/;
         result = cardnum_regex.test($(obj).val());
         
         if(!result) {
           $(obj).css('border-color', '#FB3A3A');
           $("#cardnum-result").html("Card number should be 16 digits");
           return false;
         }
         else
         {
           $("#cardnum-result").html('');
           $('#cardnum').css('border-color', '');
           return true;
         }
       }

       function checkPromo()
       {
        var coupon = document.getElementById("coupon").value;
        
        if (coupon == "")
        {
          $("#coupon-result").html("");
        }
        else
        {
          $.post('promocheck.php', {'coupon':coupon}, function(data) {
            $("#coupon-result").html(data);

            });
            $('#coupon').css('border-color', '');

            var discRate = <?php if(isset($_SESSION['discRate'])){echo $_SESSION['discRate'];}else{echo 0;}; ?>;
            if(discRate == 0)
            {
              document.getElementById("discount").innerHTML = "-";
            }
            else{
              document.getElementById("discount").innerHTML = discRate+"%";
              var total = <?php echo $total;?>;
              var remaining = ((100-discRate)/100)*total;
              document.getElementById("grandtotal").value = "$"+remaining.toFixed(2);
            }
        }
      }
        

        var dt = new Date();
        document.getElementById("date-time").innerHTML=dt.toLocaleString();
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </body>
</html>