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
        $ii = $_POST['itemID'];
        $vs = $_POST['visibility'];
        $sql = "update `item` set `ITEM NAME` = '$in', `CATEGORY` = '$c', `PRICE` = $p , `VISIBLE` = $vs where `ITEM ID` = $ii";
        $conn->query($sql);
        $_POST['updateDB'] = "";
    }


    if(isset($_POST['addItem']))
    {
        $in = $_POST['item_name'];
        $c = $_POST['category'];
        $p = $_POST['price'];
        $sql = "INSERT INTO `item` ( `ITEM NAME`, `CATEGORY`, `PRICE`, `IMAGEURL`, `VISIBLE`) VALUES
        ( '$in', '$c', $p, 'images/basic.png', 1)";
        $conn->query($sql);
        $_POST['addItem'] = "";
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
                    <th scope="col">Visibility</th>
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
                            <select class="form-control" name="category">
                                <option  <?php if($value['category'] == 'Entree'){echo "selected = \"selected\"";}?> value="Entree">Entree</option>
                                <option <?php if($value['category'] == 'Meals'){echo "selected = \"selected\"";}?>  value="Meals">Meals</option>
                                <option <?php if($value['category'] == 'Drinks'){echo "selected = \"selected\"";}?>  value="Drinks">Drinks</option>
                            </select>
                        </td>
                        <!-- Item Price -->
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" class="form-control" name="price" value="<?php echo number_format($value['price'],2,'.','')?>" required />
                            </div>
                        </td>
                        <!-- Image display -->
                        <td>
                            <img src="./<?php echo $value['imageurl']?>" alt="..." class="img-rounded" />
                        </td>

                        <td>
                            <!-- Add ID as value  -->
                            <!-- If item is hidden add disabled here -->
                            <select class="form-control" name="visibility">
                                <option <?php if($value['visible'] == 1){echo "selected = \"selected\"";}?> value="1">Yes</option>
                                <option <?php if($value['visible'] == 0){echo "selected = \"selected\"";}?> value="0">No</option>
                            </select>
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
                                <input class="form-control" name="item_name" required>
                            </td>
                            <!-- Item Category -->
                            <td>
                            <select class="form-control" name="category">
                                <option selected = "selected" value="Entree">Entree</option>
                                <option value="Meals">Meals</option>
                                <option value="Drinks">Drinks</option>
                            </select>
                            </td>
                            <!-- Item Price -->
                            <td>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" name="price"  required>
                                  </div>
                            </td>
                            <!-- Item Image -->
                            <td>
                                <img src="./images/basic.png" alt="..." class="img-fluid">
                            </td>
                            <!-- Item Image URL -->

                            <!-- Submit Button -->
                            <td colspan="2">
                                <button name="editItem" value="4" type="submit" class="btn btn-block btn-success">
                                <input type="hidden" name="addItem">    
                                Add</button>
                            </td>
                            
                          </tr>
                        
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>