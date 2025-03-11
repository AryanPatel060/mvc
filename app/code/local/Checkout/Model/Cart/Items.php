<?php
class Checkout_Model_Cart_Items extends Core_Model_Abstract {
    public function init()
    {
        $this->_resourceClassName = "Checkout_Model_Resource_Cart_Items";
        $this->_collectionClassName = "Checkout_Model_Resource_Cart_Items_Collection";
    }
}
