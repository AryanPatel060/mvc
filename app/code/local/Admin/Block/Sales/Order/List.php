<?php class Admin_Block_Sales_Order_List extends Core_Block_Layout
{
    protected $_collection;

    public function __construct()
    {
        $this->setTemplate("admin/sales/list.phtml");
        $toolbar = $this->getLayout()->createBlock("admin/widget_grid_toolbar");
        $this->addChild('toolbar', $toolbar);
        $this->init();
    }


    public function init()
    {
        $this->_collection =  Mage::getModel('sales/order')
            ->getCollection();
        $this->getChild('toolbar')->prepareToolbar();
        return $this;
    }

    public function getCollection()
    {
        return $this->_collection;
    }

    public function getOrders()
    {
        return $this->getCollection()
            ->getData();
    }
}
