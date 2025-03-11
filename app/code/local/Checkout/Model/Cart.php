<?php
class Checkout_Model_Cart extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName  = "Checkout_Model_Resource_Cart";
        $this->_collectionClassName  = "Checkout_Model_Resource_Cart_Collection";
    }

    public function addCartItem($data)
    {   
        $cartItemModel = Mage::getSingleton('checkout/cart_items');
        $data['cart_id'] = $this->getCartId();

        $productData = Mage::getModel('catalog/product')->load($data['product_id']);
        $data['price'] = $productData->getPrice();
        $data['sub_totel'] = $data['price']*$data['product_quantity'];
        $cartItemModel->setData($data);
        $cartItemModel->save();
        return $this;
    }

    public function getItemCollection()
    {
   
        $d =  Mage::getModel('checkout/cart_items')
            ->getCollection()
            ->addFieldToFilter('cart_id' , $this->getCartId());
            // print_r($this->getProductId());
            // print_r($d->getData());
            // die();
        return $d;
        
    }

    public function getProductData()
    {

    }
}
