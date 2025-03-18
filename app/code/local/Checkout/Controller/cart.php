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
        if ($this->getRequest()->isAjax()) {
            $layout->removeChild('header');
            $layout->removeChild('footer');
            // $layout->getChild('content')->getChild('list')->removeChild('filter');
        }
        $layout->getChild('head')->addScript('https://code.jquery.com/jquery-3.6.0.min.js');
        $layout->getChild('head')->addCss('page/cart.css');
        $layout->toHtml();
    }

    public function placeorderAction()
    {
        // Mage::log ($this->getRequest()->getIp());// echo "excfvgbhnjmk";

        // die();
        $cartModel = Mage::getSingleton("checkout/session")->getCart();
        $converter = Mage::getModel("checkout/converter_order");
        $converter->convert($cartModel);
        $cartModel->setIsActive(0);
        // mage::log($cartModel);
        // die;
        $cartModel->save();
        $this->getSession()->remove('cart_id');

    }
    public function updateAction()
    {
        $quantityData = $this->getRequest()->getParam('cart');
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();
        $cart->updateItem($quantityData);
        $cart->save();
        $this->redirect("checkout/cart/index");
    }
    public function applyCouponAction()
    {
        $code = $this->getRequest()->getParam('coupon_code');
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $couponModel = Mage::getModel('checkout/coupon');
        $coupones = $couponModel->getCoupons();
        $item = $cart->getItemCollection()
            ->select(['sum(main_table.sub_total)' => 'totalAmount']);
        // die();
        if (isset($coupones[$code])) {
            $cart->setCouponCode($code);
            $cart->setCouponDiscount(
                $couponModel->calculateDiscount($code, $item->getFirstItem()->totalAmount)
            );
            // Mage::log($couponModel->calculateDiscount($code, $item->getFirstItem()->totalAmount));
        }
        $cart->save();
        $this->redirect("checkout/cart/index");
    }

    public function addPaymentAction()
    {
        $method = $this->getRequest()->getParam('paymentMethod');
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $cart->setPaymentMethod($method);
        mage::log($cart);
        // die();
        $cart->save();
        $this->redirect("checkout/cart/index");
    }

    public function addShippingAction()
    {
        $method = $this->getRequest()->getParam('shippingMethod');

        // mage::log($_SERVER["REQUEST_METHOD"]);

        $shippingMethods = Mage::getModel('checkout/shipping')->getMethods();
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $cart->setShippingMethod($method);
        $cart->setShippingCharges($shippingMethods[$method]);
        mage::log($cart);
        // die();
        $cart->save();
        $this->redirect("checkout/cart/index");
    }
    public function deleteAction()
    {
        $itemId = $this->getRequest()->getQuery('itemId');

        $cart = Mage::getSingleton('checkout/session')->getCart();
        // echo $itemId;
        $cart->removeItem($itemId);
        $cart->save();

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
        // die();
        print_r($cartModel);
        // die();
        $cartModel->addCartItem($cartItemData);
        $cartModel->save();
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
