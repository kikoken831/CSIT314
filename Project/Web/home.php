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
    <title>Home</title>
  </head>
  <body>
		<?php
			$servername="localhost";
			$username="root";
			$serverpw="";
			$dbname="CSIT 314";
			$dbtable="menu";

			$conn = new mysqli($servername, $username, $serverpw, $dbname);
			if ($conn->connect_error) { die("connection failed"); }

			$sql = "select * from $dbtable where visible = true";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				while ($row=$result->fetch_assoc())
					{
						$menuArr[] = array('name' => $row["name"], 'price' => $row["price"], 'image' => $row["image"], 'menuCat' => $row["menuCat"] );
					}
			}
			//print_r($menuArr); //test array set
		?>
    <div class="bg-dark p-3">
      <div class="row mx-0 py-3 bg-light rounded-3">
        <div class="col-sm-8">
          Order #88 <small class="text-muted">Today, 20 Mar 2023, 02:34PM</small>    
          <div class="card mb-3 rounded-3">
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
							if ($value['menuCat'] == 'Entree') {?>
							<div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['name']?>',<?php echo $value['price']?>,'<?php echo $value['image']?>')">
									<img src="<?php echo $value['image']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['name']?></h6>
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
							if ($value['menuCat'] == 'Meals') {?>
							<div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['name']?>',<?php echo $value['price']?>,'<?php echo $value['image']?>')">
									<img src="<?php echo $value['image']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['name']?></h6>
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
							if ($value['menuCat'] == 'Drinks') {?>
							<div class="col">
								<div class="card" onclick="orderbasket('<?php echo $value['name']?>',<?php echo $value['price']?>,'<?php echo $value['image']?>')">
									<img src="<?php echo $value['image']?>" class="card-img-top" alt="...">
									<div class="card-body">
										<h6 class="card-title"><?php echo $value['name']?></h6>
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
      <div class="col-sm-4">
          <div class="card rounded-3">
              <div class="card-body">
                  <h6 class="d-flex justify-content-between align-items-center"><span>Cart</span><button onclick="orderbasketClear();" class="btn btn-sm btn-danger rounded-pill">Clear</button></h6>
                  <hr>
                  <ul id="cartlist" class="list-unstyled" style="height: 50vh; overflow-y:auto;"></ul>
                  <hr>
                  <ul class="list-unstyled">
                      <li class="d-flex justify-content-between align-items-center"><big>Total Items: </big><big id="totalitems" class="card-text fw-bold">0</big></li>
                      <li class="d-flex justify-content-between align-items-center"><big>Total Amount: </big> <big class="fw-bold">$ <span id="totalcost" class="card-text">0.00</span></big></li>
                        <li>
                            <hr>
                            <button class="btn btn-primary btn-lg w-100 rounded-pill">CHECK OUT</button>
                        </li>
                    </ul>
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

        }
        function totalprice(){
            if(pricearray.length === 0)
            {
                document.getElementById('totalcost').innerText = "0.00";
            }else{
                document.getElementById('totalcost').innerText =  pricearray.reduce(
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>