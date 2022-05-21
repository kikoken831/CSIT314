<?php 

//UNIT testing for PHP login logout function

//Customer Controller
require "Controller/CustomerController.php";

//valid details of a customer should return true value;
//valid email: hello1@gmail.com
//valid password: Password123

$valid_user = "hello1@gmail.com";
$valid_password = "Password123";
$cc = new CustomerController($valid_user);
$test = $cc->validateLogin($valid_password);
if($test == True)
{
    //test passed
    echo "test passed\n";
}
else{
    //test failed
    echo "test failed\n";
}

//invalid details should have validateLogin() return false
$invalid_user = "kendirck@hotmail.com";
$invalid_pass = "123123";

$cc = new CustomerController($invalid_user);
$test = $cc->validateLogin($invalid_pass);
if($test == False)
{
    //test passed
    echo "test passed\n";
}
else{
    //test failed
    echo "test failed\n";
}

//valid username but invalid password should fail the test
$cc = new CustomerController($valid_user);
$test = $cc->validateLogin($invalid_pass);
if($test == False)
{
    //test passed
    echo "test passed\n";
}
else{
    //test failed
    echo "test failed\n";
}

?>