<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>Manage Coupon Codes</title>
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
    $sql = "select `coupon`.`COUPON ID`,`coupon`.`COUPON CODE`,`manager`.NAME,`coupon`.`DISCOUNT RATE`,`coupon`.VALID
    from `coupon` INNER JOIN `manager` ON `manager`.`MANAGER ID` = `coupon`.`MANAGER ID`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        while ($row=$result->fetch_assoc())
            {
                $arr[] = array('id' => $row["COUPON ID"],'code' => $row["COUPON CODE"], 'name'
                 => $row["NAME"], 'discount rate' => $row["DISCOUNT RATE"],
                  'valid' => $row["VALID"]);
            }
    }
	?>
    <!-- Nav Bar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Makan Club Manage Coupon Codes</span>
            <!-- <a href = "manageOrders.php?menu=active" style="padding:10px; border-radius: 10px; background-color:black; color:white; text-decoration:none; margin: 5px;">Active Orders</a> -->
            <a href="manageItems.php" style="
            padding: 10px;
            border-radius: 10px;
            background-color: black;
            color: white;
            text-decoration: none;
            margin: 5px;
          ">Manage Menu Items</a>
          
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
                    <th scope="col">Coupon Code</th>
                    <th scope="col">Created by:</th>
                    <th scope="col">Discount Rate</th>
                    <th scope="col">Deactivate</th>
                    <th scope="col">Activate</th>
                    <th scope="col">Update</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($arr))
            {
                foreach($arr as $key => $value)
                {?>
                <!-- Individual Row Item -->
                <form action="manageItems" method="post">
                    <tr>
                        <!-- ID -->
                        <th scope="row"><?php echo $value['id']?></th>
                        <!-- COUPON CODE -->
                        <td>
                            <input class="form-control" name="item_name" value="<?php echo $value['code']?>" required />
                        </td>
                        <!-- manager name -->
                        <td>
                            <input class="form-control" name="category" value="<?php echo $value['name']?>" required/>
                        </td>
                        <!-- discount rate -->
                        <td>
                            <div class="input-group mb-2">
                                
                                <input type="text" class="form-control" name="price" value="<?php echo $value['discount rate']?>" required />
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <!-- Add ID as value  -->
                            <!-- If item is hidden add disabled here -->
                            <button name="deleteItem" value="1" type="submit" class="btn btn-danger" <?php if($value['valid'] == 1){echo $disabled = "disabled";}?>>
                                Hide
                            </button>
                        </td>
                        <td>
                            <!-- If item is not hidden add disabled  -->
                            <button name="editItem" value="1" type="submit" class="btn btn-success"  <?php if($value['valid'] == 0){echo $disabled = "disabled";}?>>
                                Show
                            </button>
                        </td>
                        <td>
                            <!-- If item is not hidden add disabled  -->
                            <button name="editItem" value="1" type="submit" class="btn btn-primary" >
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
                            <!-- Coupon Code -->
                            <td>
                                <input class="form-control" name="item_name" value="" required>
                            </td>
                            <!-- Manager Name -->
                            <td>
                                <input class="form-control" name="category" value="<?php echo $value['name']?>" required>
                            </td>
                            <!-- Discount Rate -->
                            <td>
                                <div class="input-group mb-2">
                                    
                                    <input type="text" class="form-control" name="price" value="" required>
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">%</div>
                                    </div>
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