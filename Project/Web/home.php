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
  .row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
  }
  .col-50 {
    -ms-flex: 50%; /* IE10 */
    flex: 50%;
  }

  .icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
  }

  label {
    margin-bottom: 10px;
    display: block;
  }

  .col-50 input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.col-50 .btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

  .row1 {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
  }

  .credit-card-box .panel-title {
    display: inline;
    font-weight: bold;
  }
  .credit-card-box .form-control.error {
      border-color: red;
      outline: 0;
      box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
  }
  .credit-card-box label.error {
    font-weight: bold;
    color: red;
    padding: 2px 8px;
    margin-top: 2px;
  }
  .credit-card-box .payment-errors {
    font-weight: bold;
    color: red;
    padding: 2px 8px;
    margin-top: 2px;
  }
  .credit-card-box label {
      display: block;
  }
  /* The old "center div vertically" hack */
  .credit-card-box .display-table {
      display: table;
  }
  .credit-card-box .display-tr {
      display: table-row;
  }
  .credit-card-box .display-td {
      display: table-cell;
      vertical-align: middle;
      width: 50%;
  }
  /* Just looks nicer */
  .credit-card-box .panel-heading img {
      min-width: 180px;
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

      $total = 0;
      if(isset($_SESSION['cart'])){
      foreach($_SESSION['cart'] as $key => $value){
        $query = mysqli_query($conn, "select * from `item` where `item id` = $key");
    
        foreach($query as $a){
            $total += $value['qty']*$a["PRICE"];
        }
      }
    }

    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      if(isset($_POST['update_qty']))
      {
        foreach($_SESSION['cart'] as $key => $value){
          $query = mysqli_query($conn, "select * from `item` where `item id` = $key");
      
          foreach($query as $a){
            if($a["ITEM ID"]==$_POST['item_id'])
            {
              $id = $a["ITEM ID"];
              $_SESSION['cart'][$id] = array("pid"=>$id, "qty"=>$_POST['quantity']);
              header("location:home.php");
            }
          }
        }
      }
    }


		?>
    <div class="bg-dark p-3">
      <div class="row mx-0 py-3 bg-light rounded-3">
        <div class="">
          Order #88 <small class="text-muted"><span id='date-time'></small>
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
          <div class="panel panel-default credit-card-box">
                  <div class="panel-body">
                      <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="form-group">
                                      <label for="cardNumber">CARD NUMBER</label>
                                      <div class="input-group">
                                          <input 
                                              type="tel"
                                              class="form-control"
                                              name="cardNumber"
                                              placeholder="Valid Card Number"
                                              autocomplete="cc-number"
                                              required autofocus 
                                          />
                                          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                      </div>
                                  </div>                            
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-xs-7 col-md-7">
                                  <div class="form-group">
                                      <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                      <input 
                                          type="tel" 
                                          class="form-control" 
                                          name="cardExpiry"
                                          placeholder="MM / YY"
                                          autocomplete="cc-exp"
                                          required 
                                      />
                                  </div>
                              </div>
                              <div class="col-xs-5 col-md-5 pull-right">
                                  <div class="form-group">
                                      <label for="cardCVC">CV CODE</label>
                                      <input 
                                          type="tel" 
                                          class="form-control"
                                          name="cardCVC"
                                          placeholder="CVC"
                                          autocomplete="cc-csc"
                                          required
                                      />
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="form-group">
                                      <label for="couponCode">COUPON CODE</label>
                                      <input type="text" class="form-control" name="couponCode" />
                                  </div>
                              </div>                        
                          </div>
                          <div class="row">
                              <div class="col-xs-12">
                                  <button class="subscribe btn btn-success btn-lg btn-block" type="button">Check Out</button>
                              </div>
                          </div>
                          <div class="row" style="display:none;">
                              <div class="col-xs-12">
                                  <p class="payment-errors"></p>
                              </div>
                          </div>
                      </form>
                  </div>
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

        var $form = $('#payment-form');
$form.find('.subscribe').on('click', payWithStripe);

/* If you're using Stripe for payments */
function payWithStripe(e) {
    e.preventDefault();
    
    /* Abort if invalid form data */
    if (!validator.form()) {
        return;
    }

    /* Visual feedback */
    $form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

    var PublishableKey = 'pk_test_6pRNASCoBOKtIshFeQd4XMUh'; // Replace with your API publishable key
    Stripe.setPublishableKey(PublishableKey);
    
    /* Create token */
    var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
    var ccData = {
        number: $form.find('[name=cardNumber]').val().replace(/\s/g,''),
        cvc: $form.find('[name=cardCVC]').val(),
        exp_month: expiry.month, 
        exp_year: expiry.year
    };
    
    Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
        if (response.error) {
            /* Visual feedback */
            $form.find('.subscribe').html('Try again').prop('disabled', false);
            /* Show Stripe errors on the form */
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.payment-errors').closest('.row').show();
        } else {
            /* Visual feedback */
            $form.find('.subscribe').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
            /* Hide Stripe errors on the form */
            $form.find('.payment-errors').closest('.row').hide();
            $form.find('.payment-errors').text("");
            // response contains id and card, which contains additional card details            
            console.log(response.id);
            console.log(response.card);
            var token = response.id;
            // AJAX - you would send 'token' to your server here.
            $.post('/account/stripe_card_token', {
                    token: token
                })
                // Assign handlers immediately after making the request,
                .done(function(data, textStatus, jqXHR) {
                    $form.find('.subscribe').html('Payment successful <i class="fa fa-check"></i>');
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $form.find('.subscribe').html('There was a problem').removeClass('success').addClass('error');
                    /* Show Stripe errors on the form */
                    $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                    $form.find('.payment-errors').closest('.row').show();
                });
              }
          });
      }
      /* Fancy restrictive input formatting via jQuery.payment library*/
      $('input[name=cardNumber]').payment('formatCardNumber');
      $('input[name=cardCVC]').payment('formatCardCVC');
      $('input[name=cardExpiry').payment('formatCardExpiry');

      /* Form validation using Stripe client-side validation helpers */
      jQuery.validator.addMethod("cardNumber", function(value, element) {
          return this.optional(element) || Stripe.card.validateCardNumber(value);
      }, "Please specify a valid credit card number.");

      jQuery.validator.addMethod("cardExpiry", function(value, element) {    
          /* Parsing month/year uses jQuery.payment library */
          value = $.payment.cardExpiryVal(value);
          return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
      }, "Invalid expiration date.");

      jQuery.validator.addMethod("cardCVC", function(value, element) {
          return this.optional(element) || Stripe.card.validateCVC(value);
      }, "Invalid CVC.");

      validator = $form.validate({
          rules: {
              cardNumber: {
                  required: true,
                  cardNumber: true            
              },
              cardExpiry: {
                  required: true,
                  cardExpiry: true
              },
              cardCVC: {
                  required: true,
                  cardCVC: true
              }
          },
          highlight: function(element) {
              $(element).closest('.form-control').removeClass('success').addClass('error');
          },
          unhighlight: function(element) {
              $(element).closest('.form-control').removeClass('error').addClass('success');
          },
          errorPlacement: function(error, element) {
              $(element).closest('.form-group').append(error);
          }
      });

      paymentFormReady = function() {
          if ($form.find('[name=cardNumber]').hasClass("success") &&
              $form.find('[name=cardExpiry]').hasClass("success") &&
              $form.find('[name=cardCVC]').val().length > 1) {
              return true;
          } else {
              return false;
          }
      }

      $form.find('.subscribe').prop('disabled', true);
      var readyInterval = setInterval(function() {
          if (paymentFormReady()) {
              $form.find('.subscribe').prop('disabled', false);
              clearInterval(readyInterval);
          }
      }, 250);

        var dt = new Date();
        document.getElementById("date-time").innerHTML=dt.toLocaleString();
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>