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
        $data['sub_total'] = $data['price'] * $data['product_quantity'];
        $cartItemModel->setData($data);

        // die();
        $cartItemModel->save();
        return $this;
    }


    public function getItemCollection()
    {
        return Mage::getModel('checkout/cart_items')
            ->getCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());
    }
}
