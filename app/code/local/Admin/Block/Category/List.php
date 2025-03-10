<?php 
class Admin_Block_Category_List extends Core_Block_Layout
{
    public $verify = [];
    public function __construct()
    {
        $this->setTemplate('admin/category/list.phtml');
    }
    public function getCategoryData()
    {
        $product = Mage::getModel('catalog/category')
            ->getCollection()
            // ->select('catalog_category.*')
            ->addFieldToFilter('Parent_id',['IS NOT' => NULL]);
            // ->selfJoin('c2 ','c2.category_id = catalog_category.parent_id',['parent_name'=>'name']);
        return $product->getData();
    }
}