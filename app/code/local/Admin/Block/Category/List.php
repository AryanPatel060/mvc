<?php
class Admin_Block_Category_List extends Core_Block_Layout
{

    public $verify = [];
    protected $_collection;
    public function __construct()
    {
        $this->setTemplate('admin/category/list.phtml');
        $toolbar = $this->getLayout()->createBlock("admin/grid_toolbar");
        $this->addChild('toolbar', $toolbar);
        $this->init();
    }

    public function init()
    {
        $this->getChild('toolbar')->setLimit(3);
        $this->_collection =  Mage::getModel('catalog/category')
            ->getCollection();
        $this->getChild('toolbar')->prepareToolbar();
        return $this;
    }

    public function getCollection()
    {
        return $this->_collection
            ->addFieldToFilter('Parent_id', ['IS NOT' => NULL]);
    }

    public function getCategoryData()
    {
        $product = $this->getCollection()
            // ->select('catalog_category.*')
            ->addFieldToFilter('Parent_id', ['IS NOT' => NULL]);
        // ->selfJoin('c2 ','c2.category_id = catalog_category.parent_id',['parent_name'=>'name']);
        return $product->getData();
    }
}
