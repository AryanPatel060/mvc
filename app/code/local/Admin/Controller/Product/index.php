<?php
class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{
    // protected $_allowed = [
    //     'list',
    //     'listAction',
    // ];
    public $data;
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Product_Index_New');
        $layout->getChild('content')->addChild('new', $new);

        $layout->getChild('head')
            ->removeJs()
            ->addJs('admin/new.js');

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Product_Index_List');
        // ->setTemplate('Admin/Product/Index/List.phtml');
        //    print_r($view);

        $layout->getChild('content')->addChild('list', $list);
        $layout->getChild('head')->addCss('admin/main.css');

        $layout->toHtml();
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('deleteid');

        $product = Mage::getModel('catalog/product');
        $product->load($id);

        $result = $product->delete();
        if ($result) {
            $data = $product->getData();
            $imagepath = $data['image'];
            unlink($imagepath);
            $product->removeData();
        }
        header("location:http://localhost/MVC/admin/product_index/list");
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $data = $request->getParam('catlog_product');
        $product = Mage::getModel('catalog/product');
        $product->setData($data);
        $insertId = $product->save();      
        header("location:http://localhost/MVC/admin/product_index/list");
    }
    public function abcAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Product_Index_New')
            ->setTemplate('Admin/Product/Index/abc.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('main2.css');
        $layout->toHtml();
    }
}
