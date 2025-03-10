<?php
class Admin_Block_Product_Index_New extends Core_Block_Template
{
    public $data = [];
    public function __construct()
    {
        $this->setTemplate('Admin/Product/Index/New.phtml');
    }

    public function getProductData()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('id');
        
        return  Mage::getModel('catalog/product')->load($id);
    }

    public function getCategoryData()
    {
        $product = Mage::getModel('catalog/category')
            ->getCollection();
            
        return $product->getData();
    }

    public function getAttributeData()
    {
        $attribute = Mage::getModel('catalog/attribute')
            ->getCollection();
        return $attribute->getData();
    }
}
