<?php
require 'Entity/Customer.php';
class CustomerController{
    private Customer $c;


public function __construct($username){
    $this->c = new Customer($username);
}


public function validateLogin($email,$password) : bool
{
    $pe = $this->c->getPassword();
    $passworddec = str_decryptaesgcm($pe,$p, "base64");
    if($passworddec == "makanClub2022pw"){
        return TRUE;
    }
    else{
        return FALSE;
    }
}


public function getId()
{
    $this->c->getID();
}
}