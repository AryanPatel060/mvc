<?php 
class Admin_Block_Category_List extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate('admin/category/list.phtml');
    }
    public function getCategoryData()
    {
        $product = Mage::getModel('catalog/category')
            ->getCollection();
        return $product->getData();
    }
}