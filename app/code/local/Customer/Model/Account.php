<?php class Customer_Model_Account extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Customer_Model_Resource_Account";
        $this->_collectionClassName = "Customer_Model_Resource_Account_Collection";
    }

    public function getFullName()
    {
        return $this->getFirstName()." ".$this->getLastName();
    }

    public function getAddressCollection()
    {
        return Mage::getModel("customer/account_address")
        ->getCollection()
        ->addFieldtoFilter("customer_id",$this->getCustomerId());
    } 
} ?>
