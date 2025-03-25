<?php
class Admin_Block_Product_Index_List extends Core_Block_Template
{
    public $data = [];
    protected $_collection;
    public function __construct()
    {
        $this->setTemplate('Admin/Product/Index/List.phtml');
        $toolbar = $this->getLayout()->createBlock("admin/widget_grid_toolbar");
        $this->addChild('toolbar', $toolbar);
        $this->init();
    }

    public function init()
    {
        $this->_collection =  Mage::getModel('catalog/product')
            ->getCollection();
        $this->getChild('toolbar')->prepareToolbar();
        return $this;
    }

    public function getCollection()
    {
        return $this->_collection;
    }

    public function getProductData()
    {
        $product = $this->getCollection()
            ->addAttributeToSelect(['color', 'brand', 'material', 'releasedate', 'madein'])
            ->leftJoin(['cat' => 'catalog_category'], 'cat.category_id = main_table.category_id', ['category_name' => 'name']);
        return $product->getData();
    }

    public function getAttributeData()
    {
        $attribute = Mage::getModel('catalog/attribute')
            ->getCollection();
        return $attribute->getData();
    }
}
