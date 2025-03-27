<?php
class Checkout_Model_Coupon extends Core_Model_Abstract
{
    public $couponCode = [
        "abc10" => 10,
        "abc20" => 20,
        "abc5" => 5
    ];
    public function getCoupons()
    {
        return $this->couponCode;
    }
    public function calculateDiscount($code, $subTotal)
    {
        // if (is_array($subTotal)) {
        //     if (isset($couponCode[$code])) {
        //         $discountedPrice = [];
        //         $discount = $couponCode[$code];
        //         foreach ($subTotal as $_subTotal) {
        //             $discountedPrice[] = ($_subTotal * $discount) / 100;
        //         }
        //         return $discountedPrice;
        //     }
        // } else {
        if (array_key_exists($code, $this->couponCode)) {
            $discount = $this->couponCode[$code];
            $discountedPrice = ((int)$subTotal * $discount) / 100;
            return $discountedPrice;
        }
        // }
    }
}
