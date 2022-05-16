<?php
include 'Entity/Coupon.php';
class CouponController{
    private $CouponList = [];

    public function __construct(){
        $this->CouponList = Coupon::getCoupons();
    }

    public function getCoupons()
    {
        return $this->CouponList;
    }

    public function updateCoupons($id,$Coupon_Code,$manager_name,$Discount_rate,$valid){

        Coupon::update($id,$Coupon_Code,$Discount_rate,$valid);
    }

    public function addCoupons($Coupon_Code,$manager_name,$Discount_rate){
        Coupon::add($Coupon_Code,$manager_name,$Discount_rate);
    }
}