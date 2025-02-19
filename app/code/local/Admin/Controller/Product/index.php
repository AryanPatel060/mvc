<?php
class Admin_Controller_Product_Index
{
    public $data ;
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Product_Index_New');
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();    
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Product_Index_List');
            // ->setTemplate('Admin/Product/Index/List.phtml');
        //    print_r($view);
        
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('deleteid');

        $product = Mage::getModel('catalog/product');
        $product->load($id);
        $product->delete();
   

        header("location:http://localhost/MVC/admin/product_index/list");
      
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $data = $request->getParam('catlog_product');
        $product = Mage::getModel('catalog/product');
        $product->setData($data);

        echo "<pre>";
        print_r($data);
        $product->save();
        header("location:http://localhost/MVC/admin/product_index/list");
    }
}
