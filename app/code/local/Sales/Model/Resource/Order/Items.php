<?php class Sales_Model_Resource_Order_Items extends Core_Model_Resource_Abstract {
    public function _construct()
    {
        $this->init("order_items","item_id");
    }
}