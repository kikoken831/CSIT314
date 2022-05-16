<?php
require 'Entity/Owner.php';
class OwnerController{
    private Owner $o;

    public function __construct($username) {
        $this->o = new Owner($username);
    }

    public function validateUser($username,$password) : bool
    {
        if($this->o->getUsername() == $username && $this->o->getPassword() == $password){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function printData($option){
        return $this->o->getData($option);
    }
}