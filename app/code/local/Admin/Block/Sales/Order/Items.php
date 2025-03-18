<?php class Admin_Block_Sales_Order_Items extends Core_Block_Layout
{
    protected $_order;
    public function __construct()
    {
        $this->setTemplate("admin/sales/order/items.phtml");
    }
    public function getOrderBlock()
    {
        return $this->_order->getOrder();
    }
    public function setOrderBlock($order)
    {
        $this->_order = $order;
        return $this;
    }
    public function getItems()
    {
        return $this->getOrderBlock()->getItemCollection()->getData();
    }
} ?>