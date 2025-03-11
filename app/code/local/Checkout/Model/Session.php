<?php
class Checkout_Model_Session extends Core_Model_Session
{
    public function getCart()
    {
        $cartId = $this->get('cart_id');
        if (is_null($cartId)) {
            echo ("null");
            $cart = Mage::getModel('checkout/cart');
            $emptyCart = [
                'customer_id' => 0,
                'TotalAmount' => 0,
            ];
            $cart->set($emptyCart);
            $cart_id = $cart->save()->getCartId();

            print_r($cart_id);

            $this->set('cart_id', $cart_id);
            $cart->load($cart_id);
            return $cart;
        } else {
            $cart = Mage::getModel('checkout/cart')
                ->load($cartId);
            return $cart;
        }
    }

    // public function 
}
