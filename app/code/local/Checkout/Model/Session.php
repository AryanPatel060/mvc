<?php
class Checkout_Model_Session extends Core_Model_Session
{
    public function getCart()
    {
        $cartId = $this->get('cart_id');
        if (is_null($cartId)) {
            $cart = Mage::getModel('checkout/cart');
            $emptyCart = [
                'customer_id' => 0,
                'total_amount' => 0,
            ];
            $cart->set($emptyCart);
            $savedCart = $cart->save();
            if (!empty($savedCart->getCartId())) {
                $this->set('cart_id', $savedCart->getCartId());
            }
            $cart->load($savedCart->getCartId());

            // die();
            return $cart;
        } else {
            $cart = Mage::getModel('checkout/cart')
                ->load($cartId);

            return $cart;
        }
    }

    // public function 
}
