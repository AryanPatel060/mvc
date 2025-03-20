<?php class Customer_Block_Index extends Core_Block_Layout
{
    protected $_customer = null;
    public function __construct()
    {
        $this->setTemplate("customer/dashboard.phtml");
        $info = $this->getLayout()->createBlock('customer/dashboard_info');
        $this->addChild('customerinfo', $info);
        $orders = $this->getLayout()->createBlock('customer/dashboard_orders');
        $this->addChild('customerorders', $orders);
        $address = $this->getLayout()->createBlock('customer/dashboard_address');
        $this->addChild('customeraddress', $address);
    }

    public function setCustomer($customer)
    {
        $this->_customer = $customer;
        return $this;
    }
    public function getCustomer()
    {
        return $this->_customer;
    }
}
