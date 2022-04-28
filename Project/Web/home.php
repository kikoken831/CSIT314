<?php session_start(); ?>
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
			//print_r($menuArr); //test array set
		?>
    <div class="bg-dark p-3">
      <div class="row mx-0 py-3 bg-light rounded-3">
        <div class="">
          Order #88 <small class="text-muted"><span id='date-time'></small>    
          <div class="card mb-3 rounded-3" onclick="activeCartModalHandler()">
          <!-- <a href="cart.php" style="width: 25%;"> -->
            <div class="btn btn-primary container">
                <div style="width: 50%;float: left;"> 
                  <i class="fa" style="font-size:30px">&#xf07a;</i>
                  <span class='badge badge-warning' id='totalitems'> 0 </span>
                </div>
                <div style="margin-left: 50%;"> 
                  <li class="d-flex justify-content-between align-items-center"> <span id="totalcost" class="card-text">$0.00</span></li>
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
							<div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['item name']?>',<?php echo $value['price']?>,'<?php echo $value['imageurl']?>')">
									<img src="<?php echo $value['imageurl']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['item name']?></h6>
										<h6 class="fw-bold">$<?php echo $value['price']?></h6>
									</div>
								</div>
							</div>
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
							<div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['item name']?>',<?php echo $value['price']?>,'<?php echo $value['imageurl']?>')">
									<img src="<?php echo $value['imageurl']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['item name']?></h6>
										<h6 class="fw-bold">$<?php echo $value['price']?></h6>
									</div>
								</div>
							</div>
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
							<div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['item name']?>',<?php echo $value['price']?>,'<?php echo $value['imageurl']?>')">
									<img src="<?php echo $value['imageurl']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['item name']?></h6>
										<h6 class="fw-bold">$<?php echo $value['price']?></h6>
									</div>
								</div>
							</div>
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
                  <h6 class="d-flex justify-content-between align-items-center"><span>Cart</span><button onclick="orderbasketClear();" class="btn btn-sm btn-danger rounded-pill">Clear</button></h6>
                  <hr>
                  <ul id="cartlist" class="list-unstyled" style="height: 50vh; overflow-y:auto;"></ul>
                  <hr>
                  <ul class="list-unstyled">
                      <li class="d-flex justify-content-between align-items-center"><big>Total Items: </big><big id="totalcartitems" class="card-text fw-bold">0</big></li>
                      <li class="d-flex justify-content-between align-items-center"><big>Total Amount: </big> <big class="fw-bold"><span id="totalcartcost" class="card-text">0.00</span></big></li>
                        <li>
                            <hr>
                            <button id="btn-checkout" type="button" onclick="checkOut()" class="btn btn-lg btn-success mr-auto ml-auto">Check Out</button>
                            <!-- <button class="btn btn-primary btn-lg w-100 rounded-pill" onclick="checkOut()">Check Out</button> -->
                        </li>
                    </ul>
              </div>
					<div class="modal-footer text-center">
						<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
						
					</div>
				</div>
			</div>
		</div>
    <script>
        const idarray = [];
        const pricearray = [];
        const itemarray = [];
        const imgarray = [];
        let i = 0;
        function orderbasketClear(){
            let orderlist = document.getElementById('cartlist');
            orderlist.innerHTML = '';
            pricearray.length = 0;
            itemarray.length = 0;
            idarray.length = 0;
            id = 0;
            imgarray.length = 0;
            itemcount();
            totalprice();
        }
        function orderbasket(item_name,item_price,img_src){
            idarray.push(i);
            itemarray.push(item_name);
            pricearray.push(item_price);
            imgarray.push(img_src);
            let orderlist = document.getElementById('cartlist');
            const orderitem = document.createElement('li');
            //orderitem.
            
            orderitem.className = 'd-flex justify-content-between align-items-center';
            const orderitempricespan = document.createElement('span')
            const orderitemname = document.createTextNode(" " + item_name);
            const orderitemprice = document.createTextNode(' $ ' + item_price.toFixed(2));
            orderitempricespan.className = 'text-danger';
            orderitempricespan.appendChild(orderitemprice);
            const deletebutton = document.createElement('button');
            const deletebuttontext = document.createTextNode('X');
            deletebutton.appendChild(deletebuttontext);
            deletebutton.setAttribute('onclick','deleteItem('+i+', this)');
            deletebutton.className = 'btn btn-danger rounded-pill';
            const orderitemimgtag = document.createElement('img');
            orderitemimgtag.src = img_src;
            orderitemimgtag.className = 'w-25 rounded-3 border border-dark';

            const orderitempricespanleft = document.createElement('span');
            orderitempricespanleft.appendChild(orderitemimgtag);

            orderitempricespanleft.appendChild(orderitemname);
            orderitempricespanleft.appendChild(orderitempricespan);
            orderitem.appendChild(orderitempricespanleft);
            orderitem.appendChild(deletebutton);
            orderlist.appendChild(orderitem);


            itemcount();
            totalprice();
            i++;
        };
        function itemcount(){
            document.getElementById('totalitems').innerText =  itemarray.length;
            document.getElementById('totalcartitems').innerText =  itemarray.length;

        }
        function totalprice(){
            if(pricearray.length === 0)
            {
                document.getElementById('totalcost').innerText = "$0.00";
                document.getElementById('totalcartcost').innerText = "$0.00";
            }else{
                document.getElementById('totalcost').innerText = "$"+pricearray.reduce(
                sumarray).toFixed(2);
                document.getElementById('totalcartcost').innerText = "$"+pricearray.reduce(
                sumarray).toFixed(2);
                function sumarray(total,num){
                    return total+num;
            };
            }

        }
        function deleteItem(orderid, button){
            const index = idarray.indexOf(orderid);
            idarray.splice(index,1);
            pricearray.splice(index,1);
            itemarray.splice(index,1);
            imgarray.splice(index,1);
            itemcount();
            totalprice();
            let orderlist = document.getElementById('cartlist');
            orderlist.removeChild(button.parentElement);
        }
        function activeCartModalHandler()
        {
          $('#exampleModalCenter').modal('show');
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