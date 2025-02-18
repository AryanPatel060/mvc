<?php
class Catalog_Block_Category_List extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('catalog/category/list.phtml');
    }
    public function getCategoryData()
    {
        $product = Mage::getModel('catalog/category')
            ->getCollection();
        return $product->getData();;
    }
}
