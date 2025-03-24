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
        $new = $this->getLayout()->createBlock('Admin/Product_Index_New');
        $this->getLayout()->getChild('content')->addChild('new', $new);

        $this->getLayout()->getChild('head')
            ->removeJs()
            ->addJs('admin/new.js');

        $this->getLayout()->toHtml();
    }
    public function listAction()
    {
        $list = $this->getLayout()->createBlock('Admin/Product_Index_List');
        $this->getLayout()->getChild('content')->addChild('list', $list);
        $this->getLayout()->getChild('head')->addCss('admin/main.css');
        $this->getLayout()->getChild('head')->addJs('admin/new.js');

        $this->getLayout()->toHtml();
    }
    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('deleteid');

        $product = Mage::getModel('catalog/product')
            ->load($id);

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
  
        $data = $this->getRequest()->getParam('catlog_product');
        $product = Mage::getModel('catalog/product')
            ->setData($data);
        $insertId = $product->save();
        header("location:http://localhost/MVC/admin/product_index/list");
    }
    public function abcAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/Product_Index_New')
            ->setTemplate('Admin/Product/Index/abc.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('main2.css');
        $layout->toHtml();
    }

    public function exportProductsAction()
    {
        Mage::getModel("catalog/product")
            ->exportData();
    }
}
