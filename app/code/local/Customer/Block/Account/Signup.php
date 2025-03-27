<?php class Customer_Block_Account_Signup extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate("customer/account/signup.phtml");
    }

    public function getCustomer()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('customerid');
        return Mage::getModel("customer/account")
            ->load($id);
    }
    public function getAddress()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('editid');
        
        return  Mage::getModel('customer/account_address')->load($id);
    }
}
