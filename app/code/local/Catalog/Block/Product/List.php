<?php 
class Catalog_Block_Product_List extends Core_Block_Layout{

    public function __construct()
    {
        $this->setTemplate('catalog/product/list.phtml');
    }

    public function getProductData()
    {
        $request = Mage::getModel('core/request');
        $categoryId = $request->getQuery('categoryid');

        $product = Mage::getModel('catalog/product')
                        ->getCollection()
                        ->addFieldToFilter('category_id',$categoryId);

        return $product->getData();
    }
}