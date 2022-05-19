<?php


require "Controller/CustomerController.php";
require "function.php";
$user = "hello1@gmail.com";
$cc = new CustomerController("hello1@gmail.com");
echo $cc->getId();