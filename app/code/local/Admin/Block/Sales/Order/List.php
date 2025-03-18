<?php class Admin_Block_Sales_Order_List extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("admin/sales/list.phtml");
    }

    public function getOrders()
    {
        return Mage::getModel('sales/order')
            ->getCollection()
            ->getData();
    }
} ?>