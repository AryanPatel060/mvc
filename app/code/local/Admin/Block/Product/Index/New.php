<?php
class Admin_Block_Product_Index_New extends Core_Block_Template
{
    public $data = [];
    public function __construct()
    {
        $this->setTemplate('Admin/Product/Index/New.phtml');
    }

    public function getProductData()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('id');

        return  Mage::getModel('catalog/product')->load($id);
    }

    public function getCategoryData()
    {
        $product = Mage::getModel('catalog/category')
            ->getCollection();
        return $product->getData();
    }
    public function getHtmlField($field, $data) {
        $field = ucfirst(strtolower($field));
        $className= sprintf("Admin_Block_Html_Elements_%s",$field);
        $element = new $className($data);
        return $element->render();
    }
}
