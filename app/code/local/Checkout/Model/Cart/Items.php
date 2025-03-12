<?php
class Checkout_Model_Cart_Items extends Core_Model_Abstract
{
    protected $_product = null;
    public function init()
    {
        $this->_resourceClassName = "Checkout_Model_Resource_Cart_Items";
        $this->_collectionClassName = "Checkout_Model_Resource_Cart_Items_Collection";
    }

    public function getProductData()
    {
        // print_r($this->getProductId());
        if (empty($this->_product)) {
            $productModel =  Mage::getModel('catalog/product')
                ->load($this->getProductId());
            $this->_product =  $productModel;
        }
        return $this->_product;
    }


    protected function _beforeSave()
    {
        $cartModel = Mage::getModel('checkout/session')->getCart();
        $itemCollection = $cartModel->getItemCollection();
        $itemCollection->addFieldTofilter('product_id', $this->getProductId());

        $item = $itemCollection->getData()[0];
        if (isset($item) && empty($this->getItemId())) {
            $oldQuantity = $item->getProductQuantity();
            $this->setProductQuantity($oldQuantity + $this->getProductQuantity());
            $this->setSubTotal($this->getPrice() * $this->getProductQuantity());
            $this->setItemId($item->getItemId());
        }
        return $this;
    }
}
