<?php
class Checkout_Block_Cart_Index extends Core_Block_Template
{
    public $cartProducts = [];
    public function __construct()
    {
        $this->setTemplate('Checkout/Cart/Index.phtml');
        $items = $this->getLayout()->createBlock('Checkout/cart_index_items');
        $this->addChild('cartitems',$items);
        $address = $this->getLayout()->createBlock('Checkout/cart_index_address');
        $this->addChild('cartaddress',$address);
        $shipping = $this->getLayout()->createBlock('Checkout/cart_index_shipping');
        $this->addChild('cartshipping',$shipping);
        $payment = $this->getLayout()->createBlock('Checkout/cart_index_payment');
        $this->addChild('cartpayment',$payment);
        $summary = $this->getLayout()->createBlock('Checkout/cart_index_summary');
        $this->addChild('cartsummary',$summary);
        
    }
    public function getCartProductData()
    {
        // $cart = $this->getSession();
        // $data = $cart->get('cartProdcuts');
        // $product = Mage::getModel('catalog/product')
        //                 ->getCollection();
        //                 $product->addFieldToFilter('product_id',['IN'=>$this->cartProducts]);
        // $cartproductsdata = $product->getData();
        $session = Mage::getSingleton('checkout/session');
        $cartModel = $session->getCart();
        $itemCollection = $cartModel->getItemCollection();

        return $itemCollection->getData();
    }
    public function setcartProducts($data)
    {
        $this->cartProducts = $data;
        return $this;
    }
    public function getCart()
    {
        $session = Mage::getSingleton('checkout/session');
        return  $session->getCart();
    }
    public function getmethods()
    {
        return Mage::getSingleton('checkout/shipping')->getmethods();
    }
    public function getAddressData()
    {
        $session = Mage::getSingleton('checkout/session');
        $shipping = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id',  $session->getCart()->getCartId());
            // ->addFieldToFilter('address_type', "Shipping");
        return $shipping->getData();
    }
}
