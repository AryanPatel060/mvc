<?php
class Catalog_Controller_Product
{
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_list')
            ->setTemplate('catalog/product/list.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('list', $view);
        $layout->toHtml();
    }
    public function viewAction()
    {
        $layout = Mage::getBlock('core/layout');
        $product = Mage::getModel('catalog/product');
        $resource = $product->getResourceModel();

        echo "<pre>";
        print_r($product);
        print_r($resource);

        $view = $layout->createBlock('catalog/product_view')
            ->setTemplate('catalog/product/view.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('view', $view);
        $layout->toHtml();
    }
    public function testAction()
    {
        // $layout = Mage::getBlock('core/layout');
        echo "<pre>";
        $product = Mage::getModel('catalog/product')
                        ->getCollection()
                        ->addFieldToFilter('product_id',15)
                        ->joinLeft('catlog_category','catlog_category.category_id  = catlog_product.category_id',['category_name'=>'name']);
        print_r($product->getData());
        die();

        

        // print_r($data);
        //     ->getCollection();
        // $data = $product->getData();

        // foreach ($data as  $d) {
        //     print_r($d);
        // }



    }
}
