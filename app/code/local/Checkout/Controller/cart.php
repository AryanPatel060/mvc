<?php
class Checkout_Controller_Cart extends Core_Controller_Front_Action
{
   
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $index = $layout->createBlock('Checkout/Cart_Index');
            
        //    print_r($view);
        $index->setcartProducts($this->getSession()->get('cartProducts'));
        $layout->getChild('content')->addChild('index', $index);
        $layout->toHtml();
    }
    public function updateAction()
    {
        $layout = Mage::getBlock('core/layout');
        $update = $layout->createBlock('Checkout/Cart_Update')
            ->setTemplate('Checkout/Cart/Update.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('update', $update);
        $layout->toHtml();
    }
    public function removeAction()
    {
        $productid = $this->getRequest()->getQuery('productid');
        $cart = $this->getSession();
        $cartProducts = $cart->get('cartProducts');
        $cartProducts = array_diff($cartProducts, [$productid]);
        $cart->set('cartProducts',$cartProducts);
        $this->redirect("checkout/cart/index");
    }
    public function addAction()
    {

        $productid = $this->getRequest()->getQuery('productid');
        // print(productid);
        $cart = $this->getSession();
        $cartProducts = $cart->get('cartProducts');
        if ($cartProducts) {
            $cartProducts[] = $productid;
            $cart->set('cartProducts', $cartProducts);
        } else {
            $cart->set('cartProducts', [$productid]);
        }
        $this->redirect("checkout/cart/index");
    }
}
