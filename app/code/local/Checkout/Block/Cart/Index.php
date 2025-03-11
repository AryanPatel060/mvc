<?php 
class Checkout_Block_Cart_Index extends Core_Block_Template
{
    public $cartProducts = [];
    public function __construct()
    {

        $this->setTemplate('Checkout/Cart/Index.phtml');
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
}