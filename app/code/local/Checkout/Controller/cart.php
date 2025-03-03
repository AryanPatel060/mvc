<?php 
class Checkout_Controller_Cart extends Core_Controller_Admin_Action
{
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $index = $layout->createBlock('Checkout/Cart_Index')
                       ->setTemplate('Checkout/Cart/Index.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('index',$index);
        $layout->toHtml();
    }
    public function updateAction()
    {
        $layout = Mage::getBlock('core/layout');
        $update = $layout->createBlock('Checkout/Cart_Update')
                       ->setTemplate('Checkout/Cart/Update.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('update',$update);
        $layout->toHtml();
    }
    public function removeAction()
    {
        $layout = Mage::getBlock('core/layout');
        $remove = $layout->createBlock('Checkout/Cart_Remove')
                       ->setTemplate('Checkout/Cart/Remove.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('remove',$remove);
        $layout->toHtml();
    }
    public function addAction()
    {
        $cart = $this->getSession();
        $productid = $this->getRequest()->getQuery('productid');
   
        $cart->add('');
    }
}