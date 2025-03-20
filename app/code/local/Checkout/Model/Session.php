<?php
class Checkout_Model_Session extends Core_Model_Session
{
    public function getCart()
    {
        $cartId = $this->get('cart_id');
        $cartId = (is_null($cartId)) ? 0 : $cartId;
        $cart = Mage::getModel('checkout/cart')
            ->load($cartId);
        // var_dump($cart->getCartId());
        if ($cart->getCartId() == "") {
            // $cart = Mage::getModel('checkout/cart');
            $customerId = $this->get('customerId');
            if($customerId == ""){
                $cart->setCustomerId(0);
            }
            else {
                $cart->setCustomerId($customerId);
            }
            $cart->setTotalAmount(0);
            $savedCart = $cart->save();
            // if (!empty($savedCart->getCartId())) {/
                $this->set('cart_id', $savedCart->getCartId());
            // }
            $cart->load($savedCart->getCartId());

            // die();
        } 
        return $cart;
    }

    // public function 
}
