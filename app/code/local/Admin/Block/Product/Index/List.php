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
            ->addAttributeToSelect(['color','brand','material','releasedate','madein'])
            ->leftJoin(['cat'=>'catalog_category'],'cat.category_id = main_table.category_id',['category_name'=>'name']);
        return $product->getData();
    }
    
    public function getAttributeData()
    {
        $attribute = Mage::getModel('catalog/attribute')
            ->getCollection();
        return $attribute->getData();
    }
}
