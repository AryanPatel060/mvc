<?php class Customer_Block_Dashboard_Address extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("customer/dashboard/address.phtml");
    }
    public function getAddresses()
    {
        return $this->getParent()
            ->getCustomer()
            ->getAddressCollection()
            ->addFieldToFilter('is_default',0)
            ->getData();
    }
    public function getDefaultAddress()
    {
        return $this->getParent()
            ->getCustomer()
            ->getAddressCollection()
            ->addFieldToFilter('is_default',1)
            ->getFirstItem();
    }
    public function getAddress()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('editid');
        
        return  Mage::getModel('customer/account_address')->load($id);
    }
    public function getCustomerId()
    {
        return $this->getParent()
            ->getCustomer()
            ->getCustomerId();
           
    }
}
