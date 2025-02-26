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
            ->select('catalog_product.*')
            ->join('catalog_category', 'catalog_product.category_id  = catalog_category.category_id ', ['category_name' => 'name'])
            // ->limit(10);
            ->offset(5);
        return $product->getData();
    }
}
