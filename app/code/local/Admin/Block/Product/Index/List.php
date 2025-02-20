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
            ->select('catlog_product.*')
            ->join('catlog_category', 'catlog_product.category_id  = catlog_category.category_id ', ['category_name' => 'name'])
            // ->limit(10);
            ->offset(5);
        return $product->getData();
    }
}
