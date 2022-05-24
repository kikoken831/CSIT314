<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Manage Orders</title>
	</head>
	<body>
	<?php
	require_once "Controller/TransactionController.php";
	?>
		<script type="text/javascript">
			function completeOrder(orderID) {
				$('#exampleModalCenter').modal('hide');
				// Get the id of the element 
				let elemId = "#" + orderID;
                
				// Appends the element to a new location
				$(elemId).appendTo("#completedOrdersContainer");

				// Edit attributes elements 
                let elem = document.getElementById(orderID)
                
                // changes on click handler()
                elem.querySelector('.btn').onclick = () => completedOrderModalHandler(orderID)
                
				// Adds completed time
                let currentTime = new Date().toLocaleTimeString();
                document.getElementById(orderID).querySelector(".completedTime").innerHTML = currentTime
				document.getElementById('modal-completedTime').innerHTML = currentTime
                document.getElementById(orderID).getElementsByTagName("h5")[2].removeAttribute("hidden")
				document.getElementById("cID").value = orderID;
					<?php
					if(isset($_POST['cID']))
					{
						$id = $_POST['cID'];
						$tc = new TransactionController();
						$tc->setOrder($id);
					}
					?>
			}
			// On click handler for active orders button
			function activeOrderModalHandler(orderID) {
				// Gets the data of the current element
				let cardIDName = "#" + orderID
				let card = document.getElementById(orderID)
				let orderTime = card.querySelector('.orderTime').innerHTML
				let foodItems = card.getElementsByClassName('food')
                let tableNum = card.querySelector('.table').value
                let paymentMethod = card.querySelector('.payment').value
                console.log(foodItems)

                let foodDict = {}

                for(let i = 0; i < foodItems.length; i ++){
                    let currElem = foodItems[i]
                    let qty = currElem.querySelector('.qty').innerHTML
                    let price = currElem.querySelector('.price').value
                    let itemName = currElem.querySelector('.itemName').innerHTML
                    foodDict[itemName] = {"qty" : qty, "price":price}
                } 
                console.log(foodDict)
                
				// Populates the data in modal 
                document.getElementById('modal-orderTime').innerHTML = orderTime;
                document.getElementById('modal-orderID').innerHTML = orderID;
                document.getElementById('modal-table').innerHTML = tableNum;
                document.getElementById('modal-payment').innerHTML = paymentMethod;
                
                // Clears existing table
                document.getElementById('modal-foodItems').innerHTML = ""
                let sum = 0
                let count = 1
                for(const key in foodDict){
                    const row = document.createElement("tr");
                    let rowSum = foodDict[key]["price"] * parseInt(foodDict[key]["qty"])
                    row.innerHTML += `<td>${count++}</td>`
                    row.innerHTML += `<td>${key}</td>`
                    row.innerHTML += `<td>${foodDict[key]["qty"]}</td>`
                    row.innerHTML += `<td>${foodDict[key]["price"]}</td>`
                    row.innerHTML += `<td>${rowSum.toFixed(2)}</td>`
                    document.getElementById('modal-foodItems').appendChild(row)
                    sum += rowSum
                }                    
                document.getElementById('modal-total').innerHTML = "$" + sum.toFixed(2)
                
                // Edits param for complete order handler
                document.getElementById('btn-completeOrder').onclick = () => completeOrder(orderID)

				// Opens Modal 
                $('#btn-completeOrder').show()
                $('#modal-completedTime').hide()
				$('#modal-completedTimeTag').hide()
				$('#exampleModalCenter').modal('show')
			}
			// On click handler for completed orders button 
            function completedOrderModalHandler(orderID){
                // Hides button 
                activeOrderModalHandler(orderID)
                $('#modal-completedTime').show()
				$('#modal-completedTimeTag').show()
                $('#btn-completeOrder').hide()
            }
		</script>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<span class="navbar-brand mb-0 h1">Makan Club Manage Orders</span>
				<a href = "manageOrders.php?menu=active" style="padding:10px; border-radius: 10px; background-color:black; color:white; text-decoration:none; margin: 5px;">Active Orders</a>
				<a href = "manageOrders.php?menu=complete" style="padding:10px; border-radius: 10px; background-color:black; color:white; text-decoration:none; margin: 5px;">Completed Orders</a>
				<button onclick="window.location.href='loginS.php'" class="btn btn-outline-danger my-2 my-lg-0" type="submit">Log Out</button>
			</div>
		</nav>
		<!-- Main Body -->
		<div class="container">
			<h1 class="text-center">Manage Orders Page</h1>
			<hr>
		<?php
		//set to default page 'active' for async render
		if(!isset($_GET['menu']))
		$_GET['menu'] = 'active';

		if(isset($_GET['menu'])) 
		{
			switch ($_GET['menu'])
			{
				case 'active' : ?>
					<!-- Active Orders List -->
					<div class="text-center">
						<hr class="d-inline-block w-25">
						<h1 class="d-inline-block">Active orders</h1>
						<hr class="d-inline-block w-25">
					</div>
					<div id="activeOrdersContainer" class="row">
						<?php
							$tc = new TransactionController();
							$transArr = $tc->getPendingList();
						
						?>
						<?php
						function str_after($str, $search)
						{
							return $search === '' ? $str : array_reverse(explode($search, $str, 2))[0];
						}
						?>
						<?php
						if (!empty($transArr)) 
						{
							foreach($transArr as $key => $value) 
							{?>
								<div class="col-sm-4 pt-4" id="<?php echo $value['transaction id']?>">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">ID: <span class="float-right orderID"> <?php echo $value['transaction id']?> </span>
											</h5>
											<h5 class="card-title"> Time: <span class="float-right orderTime"> <?php echo str_after($value['datetime'],' ') ?> </span>
											</h5>
											<h5 class="card-title" hidden>Completed Time: 
												<span class="float-right completedTime"></span>
											</h5>
											<input class="table" hidden value="<?php echo $value['table id']?>">
											<input class="payment" hidden value="Visa"> <!-- how? -->
											<hr>
											<?php 
												$id = strval($value['transaction id']);
												$cartArr = $tc->getCartItems($id);
												if (!empty($cartArr))
												{
													foreach($cartArr as $k => $v)
													{?>
													<p class="card-text">
														<p class="food">
															<span class="qty"><?php echo $v['quantity']?></span>x
															<span class="itemName"><?php echo $v['item name']?></span>
															<input class="price" hidden value=<?php echo $v['price']?>>
														</p>
													</p><?php
													}
													unset($cartArr);
												}
											?>
											<hr>
											<div class="text-center">
												<button type="button" class="btn btn-primary" onclick="activeOrderModalHandler('<?php echo $value['transaction id']?>')"> View More Details </button>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						}?>
					</div><?php

				break;

				case 'complete' : ?>
					<!-- Completed Orders List -->	
					<div class="text-center">
						<hr class="d-inline-block w-25">
						<h1 class="d-inline-block">Completed Orders</h1>
						<hr class="d-inline-block w-25">
					</div>
					<div id="activeOrdersContainer" class="row">
						<?php
							$tc = new TransactionController();
							$transArr = $tc->getCompletedList();
						?>
						<?php
						function str_after($str, $search)
						{
							return $search === '' ? $str : array_reverse(explode($search, $str, 2))[0];
						}
						?>
						<?php
						if (!empty($transArr)) 
						{
							foreach($transArr as $key => $value) 
							{?>
								<div class="col-sm-4 pt-4" id="<?php echo $value['transaction id']?>">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">ID: <span class="float-right orderID"> <?php echo $value['transaction id']?> </span>
											</h5>
											<h5 class="card-title"> Time: <span class="float-right orderTime"> <?php echo str_after($value['datetime'],' ') ?> </span>
											</h5>
											<h5 class="card-title" hidden>Completed Time: 
												<span class="float-right completedTime"></span>
											</h5>
											<input class="table" hidden value="<?php echo $value['table id']?>">
											<input class="payment" hidden value="Visa"> <!-- how? -->
											<hr>
											<?php 
												$id = strval($value['transaction id']);
												$cartArr = $tc->getCartItems($id);
												if (!empty($cartArr))
												{
													foreach($cartArr as $k => $v)
													{?>
													<p class="card-text">
														<p class="food">
															<span class="qty"><?php echo $v['quantity']?></span>x
															<span class="itemName"><?php echo $v['item name']?></span>
															<input class="price" hidden value=<?php echo $v['price']?>>
														</p>
													</p><?php
													}
													unset($cartArr);
												}
											?>
											<hr>
											<div class="text-center">
												<button type="button" class="btn btn-primary" onclick="completedOrderModalHandler('<?php echo $value['transaction id']?>')"> View More Details </button>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						}?>
					</div><?php

				break;

				}	
		}?>
		<!-- Button trigger modal -->
		<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Launch demo modal
        </button> -->
		<!-- Modal for order details -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title"> Order Details </h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h6>Order ID: 
                            <span id="modal-orderID" class="float-right"></span>
						</h6>
						<h6>Order Time: 
                            <span id="modal-orderTime" class="float-right"></span>
						</h6>
						<h6>Table: 
                            <span id="modal-table" class="float-right"></span>
						</h6>
						<h6>Payment: 
                            <span id="modal-payment" class="float-right"></span>
						</h6>
                        <h6 id="modal-completedTimeTag">Completed Time: 
                            <span id="modal-completedTime" class="float-right"></span>
						</h6>
						<hr>
						<div class="itemContainer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Item name</th>
										<th>Qty</th>
										<th>Unit Price</th>
										<th>Total Price</th>
									</tr>
								</thead>
								<tbody id="modal-foodItems">
									<!-- Food Item in list -->
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4"></th>
										<th id="modal-total"></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="modal-footer text-center">
						<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
						<form method="post" name="form" action="manageOrders.php">
						<input type="hidden" id="cID" name="cID">
						<button id="btn-completeOrder" type="submit" onclick="completeOrder()" class="btn btn-lg btn-success mr-auto ml-auto">Complete Order</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal for Completed Orders -->
		<!-- Completed Orders List -->

		</div>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>