<?php
include 'Entity/Manager.php';

class ManagerController{
    private Manager $m;

    public function __construct($username) {
        $this->m = new Manager($username);
    }

    public function validateUser($username,$password) : bool
    {
        if($this->m->getUsername() == $username && $this->m->getPassword() == $password){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }


}