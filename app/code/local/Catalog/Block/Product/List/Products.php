<?php
class Catalog_Block_Product_List_Products extends Catalog_Block_Product_List
{
    protected $_collection ;
    public function __construct()
    {
        $this->setTemplate('catalog/product/list/products.phtml');
        $toolbar = $this->getLayout()->createBlock('admin/grid_toolbar')
            ->setTemplate('catalog/grid/toolbar.phtml');
        $this->addChild('toolbar', $toolbar);
        $this->init();
    }
    public function init()
    {
        $this->_collection =  Mage::getModel('catalog/filter')
            ->getProductCollection();   
        $this->getChild('toolbar')->prepareToolbar();
        return $this;
    }

    public function getCollection()
    {
        return $this->_collection;
    }
}
