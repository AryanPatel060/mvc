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

        $minprice = $request->getQuery('minprice');
        $minprice = ($minprice == "")? 1 :$minprice;

        // die;

        $product = Mage::getModel('catalog/product')
                        ->getCollection()
                        ->addFieldToFilter('category_id',$categoryId)
                        ->addFieldToFilter('price',['>'=>$minprice]);

        return $product->getData();
    }

    public function getCategoryData(){
        $category = Mage::getModel('catalog/category')
                    ->getCollection();
        return $category->getData();
    }

    public function getPriceRange(){
        $product =Mage::getModel("catalog/product")
                        ->getCollection();
                $product->select(['price ']);
        $range = $product->getData();
 

    }
}