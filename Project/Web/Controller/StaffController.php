<?php
include 'Entity/Staff.php';
class StaffController{
    private  $s;

    public function __construct($username){
        $this->s= new Staff($username);
        //var_dump($this->s);
    }

    public function validateStaff($username,$password) : bool
    {
        if($this->s->getUsername() == $username && $this->s->getPassword() == $password )
        {
            return TRUE;
        }
        else{
            return False;
        }
    }
}