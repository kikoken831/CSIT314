<?php
class Coupon{
    private $id;
    private $Coupon_Code;
    private $Discount_rate;
    private $valid;
    private $manager_id;

    public function __construct($id,$Coupon_Code,$manager_name,$Discount_rate,$valid)
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select `manager id` from `manager` where `name` = '$manager_name' limit 1";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $this->manager_id = $row['manager id'];
        }
        $this->id = $id;
        $this->Coupon_Code = $Coupon_Code;
        $this->Discount_rate = $Discount_rate;
        $this->valid = $valid;

        

    }

    static public function update($id,$Coupon_Code,$Discount_rate,$valid)
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "update `coupon` set `COUPON CODE` = '$Coupon_Code', `MANAGER ID` = 1, 
        `DISCOUNT RATE` = $Discount_rate , `VALID` = $valid where `COUPON ID` = $id";
        $conn->query($sql);
    }
    static public function getCoupons(){
        $conn = new mysqli("localhost", "root", "", "restaurant");
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
        return $arr;
    }

    static public function add($Coupon_Code,$manager_name,$Discount_rate){
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "INSERT INTO `COUPON` ( `COUPON CODE`, `MANAGER ID`, `DISCOUNT RATE`, `VALID`) VALUES
        ('$Coupon_Code', 1, $Discount_rate, 1)";
        $conn->query($sql);
    }
}