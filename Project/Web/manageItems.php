<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>Manage Menu Items</title>
</head>

<body>
    <?php
	//db connection initialise
	$servername="localhost";
	$username="root";
	$serverpw="";
	$dbname="restaurant";
	$conn = new mysqli($servername, $username, $serverpw, $dbname);
	if ($conn->connect_error) { die("connection failed"); }

    //update db
    if(isset($_POST['updateDB']))
    {
        $in = $_POST['itemname'];
        $c = $_POST['category'];
        $p = $_POST['price'];
        $iu = $_POST['imageurl'];
        $ii = $_POST['itemID'];
        $sql = "update `item` set `ITEM NAME` = '$in', `CATEGORY` = '$c', `PRICE` = $p where `ITEM ID` = $ii";
        $conn->query($sql);
        $_POST['updateDB'] = "";
    }
    

    //pull all items
    $sql = "select * from `item`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        while ($row=$result->fetch_assoc())
            {
                $transArr[] = array('item id' => $row["ITEM ID"],'item name' => $row["ITEM NAME"], 'category'
                 => $row["CATEGORY"], 'price' => $row["PRICE"], 'imageurl' => $row["IMAGEURL"],
                  'visible' => $row["VISIBLE"]);
            }
    }
    ?>
    

    <!-- Nav Bar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Makan Club Manage Menu Items</span>
            <!-- <a href = "manageOrders.php?menu=active" style="padding:10px; border-radius: 10px; background-color:black; color:white; text-decoration:none; margin: 5px;">Active Orders</a> -->
            <a href="manageCoupons.php" style="
            padding: 10px;
            border-radius: 10px;
            background-color: black;
            color: white;
            text-decoration: none;
            margin: 5px;
          ">Manage Coupon Codes</a>
          
            <button onclick="window.location.href='login.php'" class="btn btn-outline-danger my-2 my-lg-0"
                type="submit">
                Log Out
            </button>
        </div>
    </nav>
    <!-- Body Container -->
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Image Source</th>
                    <th scope="col">Hide</th>
                    <th scope="col">Show</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($transArr))
            {
                foreach($transArr as $key => $value)
                {?>
                <!-- Individual Row Item -->
                <form action="manageItems.php" method="post" name="form">
                    <tr>
                        <!-- Item ID -->
                        <th scope="row"><?php echo $value['item id']?></th>
                            <input type="hidden" name="itemID" value="<?php echo $value['item id']?>">
                        <!-- Item Name -->
                        <td>
                            <input class="form-control" name="itemname" value="<?php echo $value['item name']?>" required />
                        </td>
                        <!-- Item Category -->
                        <td>
                            <input class="form-control" name="category" value="<?php echo $value['category']?>" required/>
                        </td>
                        <!-- Item Price -->
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" class="form-control" name="price" value="<?php echo $value['price']?>" required />
                            </div>
                        </td>
                        <!-- Image display -->
                        <td>
                            <img src="./<?php echo $value['imageurl']?>" alt="..." class="img-rounded" />
                        </td>
                        <!-- Image Upload URL -->
                        <td>
                            <input class="form-control" name="imageurl" value="<?php echo $value['imageurl']?>" required/>
                        </td>
                        <td>
                            <!-- Add ID as value  -->
                            <!-- If item is hidden add disabled here -->
                            <button name="deleteItem" type="submit" class="btn btn-danger" <?php if($value['visible'] == 0){echo $disabled = "disabled";}?>>
                                Hide
                            </button>
                        </td>
                        <td>
                            <!-- If item is not hidden add disabled  -->
                            <button name="editItem" type="submit" class="btn btn-success" <?php if($value['visible'] == 1){echo $disabled = "disabled";}?>>
                                Show
                            </button>
                        </td>
                        <td>
                            <!-- If item is not hidden add disabled  -->
                            <button name="updateItem" type="submit" class="btn btn-primary">
                                <input type="hidden" name="updateDB" value="update">
                                Update
                            </button>
                        </td>
                    </tr>
                </form>
                <?php
                }
            }?>


                <!-- Final column to add new entires  -->
                <tr>
                    <form action="manageItems.php" method="post">
                    
                        <tr>
                            <!-- Number of items + 1 -->
                            <th scope="row">
                                
                            </th>
                            <!-- Item Name -->
                            <td>
                                <input class="form-control" name="item_name" value="" required>
                            </td>
                            <!-- Item Category -->
                            <td>
                                <input class="form-control" name="category" value="" required>
                            </td>
                            <!-- Item Price -->
                            <td>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" name="price" value="" required>
                                  </div>
                            </td>
                            <!-- Item Image -->
                            <td>
                                <img src="./images/basic.png" alt="..." class="img-fluid">
                            </td>
                            <!-- Item Image URL -->
                            <td>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile"  name="imageURL" value="images/basic.png">
                                    <label class="custom-file-label" for="validatedCustomFile">...</label>
                                </div>
                            </td>
                            <!-- Submit Button -->
                            <td colspan="2">
                                <button name="editItem" value="4" type="submit" class="btn btn-block btn-success">Add</button>
                            </td>
                            
                          </tr>
                        
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>