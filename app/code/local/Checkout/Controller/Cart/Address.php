<?php
class Checkout_Controller_Cart_Address extends Core_Controller_Front_Action
{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('checkout/cart_new');

        $layout->getChild('content')->addchild('new', $new);
        $layout->toHtml();
    }

    public function addaction()
    {
        $shipping = $this->getRequest()->getParam('shipping');
        $billing = $this->getRequest()->getParam('billing');
        $customerEmail = $this->getRequest()->getParam('customer_email');
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();

        $shipping['cart_id'] = $cart->getcartId();
        $billing['cart_id'] = $cart->getCartId();
        $cart->setCustomerEmail($customerEmail);
        $cartAddress = Mage::getModel('checkout/cart_address');
        $cartAddress->setData($shipping);
        $cartAddress->save();
        $cartAddress->setData($billing);
        $cartAddress->save();
        $cart->save();
        $this->redirect("checkout/cart/index");

    }
}
