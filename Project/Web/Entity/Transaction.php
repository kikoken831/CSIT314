<?php

class Transaction{
    private $id;
    private $table;
    private $custID;
    private $coupon;
    private $staffID;
    private $status;
    private $datetime;
    private $price;

    public function __construct($id,$table,$custID,$coupon,$staffID,$status,$datetime,$price){
        $this->id = $id;
        $this->table = $table;
        $this->custID = $custID;
        $this->coupon = $coupon;
        $this->staffID = $staffID;
        $this->status = $status;
        $this->datetime = $datetime;
        $this->price = $price;
    }

    static public function updateStatus($id)
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "update transaction set status = 'COMPLETED' where `transaction id` = $id";
		$conn->query($sql);
    }

    static public function getCompleted()
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from transaction where date(datetime) = curdate() and status = 'COMPLETED'"; //select * from transaction where date(datetime) = date(now())
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while ($row=$result->fetch_assoc())
                {
                    $transArr[] = array('transaction id' => $row["TRANSACTION ID"],'table id' => $row["TABLES ID"], 'customer id' => $row["CUSTOMER ID"], 'coupon id' => $row["COUPON ID"], 'staff id' => $row["STAFF ID"], 'status' => $row["STATUS"], 'datetime' => $row["DATETIME"], 'total price' => $row["TOTAL PRICE"]);
                }
        }
        return $transArr;
    }

    static public function getItems($id)
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from cartitem join item on cartitem.`item id` = item.`item id` where cartitem.`transaction id`= $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while ($row=$result->fetch_assoc())
                {
                    $cartArr[] = array('item id' => $row["ITEM ID"], 'quantity' => $row["QUANTITY"], 'item name' => $row["ITEM NAME"], 'price' => $row["PRICE"]);
                } 
        }
        return $cartArr;
    }
    static public function getPending()
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from transaction where status = 'PENDING'"; //select * from transaction where date(datetime) = date(now())
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while ($row=$result->fetch_assoc())
                {
                    $transArr[] = array('transaction id' => $row["TRANSACTION ID"],'table id' => $row["TABLES ID"], 'customer id' => $row["CUSTOMER ID"], 'coupon id' => $row["COUPON ID"], 'staff id' => $row["STAFF ID"], 'status' => $row["STATUS"], 'datetime' => $row["DATETIME"], 'total price' => $row["TOTAL PRICE"]);
                }
            return $transArr;
        }
        else{
            return null;
        }
    }

    static public function getHistory($id)
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from transaction where `customer id` = $id order by `transaction ID` desc"; 
        $result = $conn->query($sql);
        {
            while ($row=$result->fetch_assoc())
                {
                    $transArr[] = array('transaction id' => $row["TRANSACTION ID"],'table id' => $row["TABLES ID"], 'customer id' => $row["CUSTOMER ID"], 'coupon id' => $row["COUPON ID"], 'staff id' => $row["STAFF ID"], 'status' => $row["STATUS"], 'datetime' => $row["DATETIME"], 'total price' => $row["TOTAL PRICE"]);
                }
        }
        return $transArr;
    }
}