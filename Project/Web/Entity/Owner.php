<?php

class Owner{
    private $conn;
    private $OID;
    private $O_username;
    private $password;
    private $name;
    public  function __construct($username)
    {
        $this->conn = new mysqli("localhost", "root", "", "restaurant");
        $this->O_username = $username;
        $this->setPassword();
    }
    public function setPassword(){
        $sql = "SELECT PASSWORD FROM owner WHERE USERNAME = '$this->O_username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $this->password = $row["PASSWORD"];
                }
            }
        
    }
    public function getUsername()
    {
        return $this->O_username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getData($option)
    {
        if($option == 1){
            $sql = "select
            A.count, B.count 
            from 
            (select count(*) as count from transaction ) A, 
            (select count(*) as count from transaction where `CUSTOMER ID` = 1) B
            ";
        }
        if($option == 2){
            $sql = "select DATE(DATETIME)as date, AVG (`TOTAL PRICE`) from transaction group by date order by date;";
        }
        if($option == 3){
            $sql = "select DATE(DATETIME)as date, count(`transaction ID`) from transaction group by date order by date;";
        }
        if($option == 4){
            $sql = "select cartitem.`ITEM ID`, sum(cartitem.QUANTITY) as total, item.`ITEM NAME` 
            from cartitem join item on cartitem.`ITEM ID` = item.`ITEM ID` group by `ITEM ID` 
            order by total desc limit 3";
        }
        $result = $this->conn->query($sql);
        return $result;

    }
}

