<?php

class Customer{

    private $email;
    private $id;
    private $psw;
    private $conn;

    public function __construct($email){
        $this->conn = new mysqli("localhost", "root", "", "restaurant");
        $this->email = $email;
        $this->setPassword($email);
    }

    public function setPassword(){
        $sql = "SELECT `CUSTOMER ID`, `PASSWORD` FROM customer WHERE email = '$this->email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $this->id = $row["CUSTOMER ID"];
                    $this->psw = $row["PASSWORD"];
                }
            }
        
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getPwd()
    {
        return $this->psw;
    }

}