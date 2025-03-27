<?php class Admin_Block_Sales_Order extends Core_Block_Layout
{
    protected $_order;
    public function __construct()
    {   
        $this->setTemplate('admin/sales/order.phtml');
       
    }
    public function setOrder($model)
    {
        $this->_order=$model;
        return $this;
    }
    public function getOrder()
    {
        return $this->_order;
    }
} ?>
