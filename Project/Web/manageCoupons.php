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
    require_once 'Controller/CouponController.php';
	
    $cc = new CouponController();

    if(isset($_POST['updateCoupon']))
    {
        $id = $_POST['id'];
        $Coupon_Code = $_POST['code'];
        $manager_name = $_POST['name'];
        $Discount_rate = $_POST['rate'];
        $valid = $_POST['valid'];
        
        $cc->updateCoupons($id,$Coupon_Code,$manager_name,$Discount_rate,$valid);
        
        $_POST['updateCoupon'] = "";
        $page = $_SERVER['PHP_SELF'];
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">'; 
    }


    if(isset($_POST['addCoupon']))
    {
        $Coupon_Code = $_POST['code'];
        $Discount_rate = $_POST['rate'];
        $mn = $_POST['name'];
        $cc->addCoupons($Coupon_Code,$mn,$Discount_rate);
        $_POST['addItem'] = "";
        $page = $_SERVER['PHP_SELF'];
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">'; 
    }

    $arr = $cc->getCoupons();
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
                    <th scope="col">Valid</th>
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
                <form action="manageCoupons.php" method="post">
                    <tr>
                        <!-- ID -->
                        <th scope="row"><?php echo $value['id']?></th>
                            <input type="hidden" name="id" value="<?php echo $value['id']?>">
                        <!-- COUPON CODE -->
                        <td>
                            <input class="form-control" name="code" value="<?php echo $value['code']?>" required />
                        </td>
                        <!-- manager name -->
                        <td>
                            <input class="form-control" name="manager_name" value="<?php echo $value['name']?>" required disabled/>
                                <input type="hidden" class="form-control" name="name" value="<?php echo $value['name']?>">
                        </td>
                        <!-- discount rate -->
                        <td>
                            <div class="input-group mb-2">
                                
                                <input type="text" class="form-control" name="rate" value="<?php echo $value['discount rate']?>" required />
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <select class="form-control" name="valid">
                                <option  <?php if($value['valid'] == 0){echo "selected = \"selected\"";}?> value="0">NO</option>
                                <option <?php if($value['valid'] == 1){echo "selected = \"selected\"";}?>  value="1">YES</option>
                            </select>
                        <td>
                            <!-- If item is not hidden add disabled  -->
                            <button name="editItem" value="1" type="submit" class="btn btn-primary" >
                                <input type="hidden" name = "updateCoupon">
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
                    <form action="manageCoupons.php" method="post">
                    
                        <tr>
                            <!-- Number of items + 1 -->
                            <th scope="row">
                                
                            </th>
                            <!-- Coupon Code -->
                            <td>
                                <input class="form-control" name="code" value="" required>
                            </td>
                            <!-- Manager Name -->
                            <td>
                                <input class="form-control" name="manager_name" value="<?php echo $value['name']?>" required disabled>
                                    <input type="hidden" class="form-control" name="name" value="<?php echo $value['name']?>">
                            </td>
                            <!-- Discount Rate -->
                            <td>
                                <div class="input-group mb-2">
                                    
                                    <input type="text" class="form-control" name="rate" value="" required>
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">%</div>
                                    </div>
                                  </div>
                            </td>
                            
                            <!-- Submit Button -->
                            <td colspan="2">
                                <button name="editItem" value="4" type="submit" class="btn btn-block btn-success">Add</button>
                                <input type="hidden" name = "addCoupon">
                            </td>
                            
                          </tr>
                        
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>