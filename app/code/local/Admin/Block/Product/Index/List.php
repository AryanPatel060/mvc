<?php
class Admin_Block_Product_Index_List extends Core_Block_Template
{
    public $data = [];
    public function __construct()
    {
        $this->setTemplate('Admin/Product/Index/List.phtml');
    }

    public function getProductData()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect(['color','brand']);
        return $product->getData();
    }
}
