
<?php class Admin_Block_Sales_Order_Address extends Core_Block_Layout {
    // protected $_order;
    public function __construct()
    {   
        $this->setTemplate('admin/sales/order/address.phtml');
    }
    public function getOrderBlock()
    {
        return $this->getparent()->getOrder();
    }
    // public function setOrderBlock($order)
    // {
    //     $this->_order = $order;
    //     return $this;
    // }
    public function getAddressData()
    {
        return $this->getOrderBlock()->getAddressCollection()->getData();
    }
} ?>