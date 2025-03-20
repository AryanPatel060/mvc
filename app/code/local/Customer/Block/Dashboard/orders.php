<?php class Customer_Block_Dashboard_Orders extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("customer/dashboard/orders.phtml");
    }
    public function getOrders()
    {
        $id = $this->getParent()->getCustomer()
            ->getCustomerId();
        return Mage::getModel("sales/order")
            ->getCollection()
            ->addFieldToFilter('customer_id', $id)
            ->getData();
        // ->prepareQuery();
    }
}
