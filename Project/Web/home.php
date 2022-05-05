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
    $id = $_GET['remove'];
    session_unset($_SESSION['cart'][$id]);
    header("location:home.php");
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

		?>
    <div class="bg-dark p-3">
      <div class="row mx-0 py-3 bg-light rounded-3">
        <div class="">
          Order #88 <small class="text-muted"><span id='date-time'></small>    
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
                  <h6 class="d-flex justify-content-between align-items-center"><span>Cart</span><button onclick="orderbasketClear();" class="btn btn-sm btn-danger rounded-pill">Clear</button></h6>
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
                          <th>Action</th>
                        </tr>
                      </thread>
                      <tbody>
                      <?php
       
                      foreach($_SESSION['cart'] as $key => $value){
                        $query = mysqli_query($conn, "select * from `item` where `item id` = $key");

                        foreach($query as $a){
                          echo "<tr>
                            <td><img src='".$a["IMAGEURL"]."' width=\"100\" height=\"100\"/></td>
                            <td>".$a["ITEM NAME"]."</td>
                            <td>$".$a["PRICE"]."</td>
                            <td>".$value['qty']."</td>
                            <td>".$value['qty']*$a["PRICE"]."</td>
                            <td><a class='btn btn-danger btn-sm' href='?remove=".$key."'>Delete</a></td>
                            </tr>";
                        }
                      }
                      ?>
                        </tbody>
                        
                      </table>
                        <li>
                          <h5>Total Amount: <?php echo number_format($total, 2);?></h5>
                            <hr>
                            <button id="btn-checkout" type="button" onclick="checkOut()" class="btn btn-lg btn-success mr-auto ml-auto">Check Out</button>
                        </li>
                    </ul>
                    <?php

                      }

                    ?>
              </div>
              
					<div class="modal-footer text-center">						
					</div>
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