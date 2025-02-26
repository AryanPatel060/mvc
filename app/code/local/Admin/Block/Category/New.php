<?php 
class Admin_Block_Category_New extends Core_Block_Layout
{
    public $categories = [];
    public function __construct()
    {
        $this->setTemplate('admin/Category/new.phtml');

    }
    public function getEditCategoryData()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('id'); 
        return  Mage::getModel('catalog/category')->load($id);
    }

    public function getCategoryData()
    {
        $product = Mage::getModel('catalog/category')
            ->getCollection();
        return $product->getData();
    }

}