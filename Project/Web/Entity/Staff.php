<?php

class Staff{
    private $Username;
    private $password;
    private $name;

    public function __construct($username){
        $this->Username = $username;
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "SELECT PASSWORD FROM staff WHERE USERNAME = '$username'";
        $result = $conn->query($sql);
        $password_db = "";
        if ($result->num_rows > 0) 
                {
                  while($row = $result->fetch_assoc()) 
                  {
                    $password_db = $row["PASSWORD"];
                  }
        }
        $this->password = $password_db;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUsername()
    {
        return $this->Username;
    }
}