<?php

class Manager{

    private $conn;
    private $MID;
    private $M_username;
    private $password;
    private $name;
    public  function __construct($username)
    {
        $this->conn = new mysqli("localhost", "root", "", "restaurant");
        $this->M_username = $username;
        $this->setPassword();
    }
    public function setPassword(){
        $sql = "SELECT PASSWORD FROM manager WHERE USERNAME = '$this->M_username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $this->password = $row["PASSWORD"];
                }
            }
        
    }
    public function getUsername(){
        return $this->M_username;
    }
    public function getPassword(){
        return $this->password;
    }
}