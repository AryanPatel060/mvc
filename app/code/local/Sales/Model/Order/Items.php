<?php class Sales_Model_Order_Items extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Sales_Model_Resource_Order_Items";
        $this->_collectionClassName = "Sales_Model_Resource_Order_Items_Collection";
    }
}
