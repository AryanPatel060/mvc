<?php
class Checkout_Block_Cart_New extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("checkout/cart/address.phtml");
    }
    public function getShippingAddress()
    {
        $session = Mage::getSingleton('checkout/session');
        $shipping = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id',  $session->getCart()->getCartId())
            ->addFieldToFilter('address_type', "Shipping");
        return $shipping->getFirstItem();
    }
    public function getBillingAddress()
    {
        $session = Mage::getSingleton('checkout/session');
        $shipping = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id',  $session->getCart()->getCartId())
            ->addFieldToFilter('address_type', "Billing");
        return $shipping->getFirstItem();
    }
    public function getCart()
    {
        $session = Mage::getSingleton('checkout/session');
        return  $session->getCart();
    }
}
