<?php 
class Catalog_Block_Product_View extends Core_Block_Layout{
    public function __construct()
    {
        $this->setTemplate('catalog/product/view.phtml');
    }

    // public function getProduct()
    // {
    //     $request = Mage::getModel('core/request');
    //     $productId = $request->getQuery('productid');

    //     $product = Mage::getModel('catalog/product')
    //                     ->getCollection()
    //                     ->addFieldToFilter('product_id',$productId);
    //                     // ->addAttributeToSelect(['type']);
        
    //     // $this->getImage($productId);

    //     return $product->getData();
    // }



    public function getProductData()
    {
        $request = Mage::getModel('core/request');
        $productId = $request->getQuery('productid');

        $product = Mage::getModel('catalog/product')
            ->load($productId);
            
        return $product;
    }
    public function getIamgesProduct()
    {
        $request = Mage::getModel('core/request');
        $productId = $request->getQuery('productid');
        $images = $this->getImage($productId);
        return $images;

    }
    public function getAttributes()
    {
        $request = Mage::getModel('core/request');
        $productId = $request->getQuery('productid');
        $attribute = Mage::getModel('catalog/attribute')
                        ->getCollection();
                               
        //                         // ->addFieldToFilter('product_id',$productId);
        //                         // // ->leftJoin('catalog_attribute','catalog_product_attribute.attribute_id = catalog_attribute.attribute_id',);
        //                         // // ['attributname'=>'name','attributetype'=>'type']
        //       echo"<pre>";      
        // print_r( $attribute->getData());
        // die();        
        return $attribute->getData();
    }
}