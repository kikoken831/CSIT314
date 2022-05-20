<?php
require 'Entity/Customer.php';
require_once 'function.php';
class CustomerController{
    private Customer $c;


public function __construct($username){
    $this->c = new Customer($username);
}


public function validateLogin($password)
{
    $verifypassword = $this->c->getPwd();
    $decryptytext = str_decryptaesgcm($verifypassword, $password, "base64");

    if($decryptytext == "makanClub2022pw")
    {
        return True;
    }
    else{
        return False;
    }
}
public function getId()
{
    return $this->c->getID();
}
}