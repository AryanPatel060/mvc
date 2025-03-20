<?php class Customer_Block_Dashboard_Info extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("customer/dashboard/info.phtml");
    }

    public function getCustomerInfo()
    {
        return Mage::getModel('customer/account')
            ->load(
                $this->getParent()
                    ->getCustomer()
                    ->getCustomerId()
            );
    }
}
