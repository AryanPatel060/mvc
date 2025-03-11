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
        $cart->set('cartProducts', $cartProducts);
        $this->redirect("checkout/cart/index");
    }
    public function addAction()
    {
        $request = $this->getRequest();
        $cartItemData = $request->getParam('cart');
        // $productid = $cartData['product_id'];
        // $quantity = $cartData['product_quantity'];

        // Mage::getModel('cart')
        $session = Mage::getSingleton('checkout/session');
        $cartModel = $session->getCart();
        $cartModel->addCartItem($cartItemData);

        $this->redirect("checkout/cart/index");



        

        //---------- add fucntion on cart model 
        // get item model set all data 
        // before save for updating total amount
        // before save for items and get price from product
        // get item collection ---> in cart model 
        // block get cart in session file
        // no any item model will made 
        // get productData() in cart model returns 


        // die();
        // $productid = $this->getRequest()->getQuery('productid');
        // // print(productid);
        // $cart = $this->getSession();
        // $cartProducts = $cart->get('cartProducts');
        // if ($cartProducts) {
        //     $cartProducts[] = $productid;
        //     $cart->set('cartProducts', $cartProducts);
        // } else {
        //     $cart->set('cartProducts', [$productid]);
        // }
    }
}
