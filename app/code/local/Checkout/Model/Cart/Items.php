<?php
class Checkout_Model_Cart_Items extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Checkout_Model_Resource_Cart_Items";
        $this->_collectionClassName = "Checkout_Model_Resource_Cart_Items_Collection";
    }

    public function getProductData()
    {
        // print_r($this->getProductId());
        
        $productModel =  Mage::getModel('catalog/product')
            ->load($this->getProductId());
        
        return $productModel;
    }


    protected function _beforeSave()
    {

        $cartModel = Mage::getModel('checkout/session')->getCart();
        $itemCollection = $cartModel->getItemCollection();

        $itemCollection->addFieldTofilter('product_id' , $this->getProductId());
        echo"<pre>";

        $item = $itemCollection->getData()[0];
        if(isset($item))
        {
            $oldQuantity = $item->getProductQuantity();
            $this->setProductQuantity($oldQuantity+$this->getProductQuantity());
            $this->setSubTotal($this->getPrice()*$this->getProductQuantity());
            $this->setItemId($item->getItemId());
            // print_r($this);
            // die();
        }

        $updatedTotal = (float)$cartModel->getTotalAmount() + $this->getSubTotal();
        // we have to make quary to get total amount here
        $cartModel->setTotalAmount($updatedTotal);
        $cartModel->save();
        // print_r($this);
        return $this;
    }
}
