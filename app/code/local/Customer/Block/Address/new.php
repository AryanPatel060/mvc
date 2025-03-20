<?php class Customer_Block_Address_New extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("customer/address/new.phtml");
    }

    public function getAddress()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('id');
        
        return  Mage::getModel('customer/account_address')->load($id);
    }
}