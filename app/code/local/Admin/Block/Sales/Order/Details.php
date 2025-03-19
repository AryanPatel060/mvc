<?php 
class Admin_Block_Sales_Order_Details extends Admin_Block_Sales_Order
{
    // protected $_parent ;
    public function __construct()
    {   
        $this->setTemplate('admin/sales/order/details.phtml');
    }

    public function getorder()
    {
        return $this->getParent()->getOrder();
    }
    // public function setOrderBlock($parent)
    // {
    //     $this->_parent = $parent;
    //     return $this;

    // }
    // public function getParent()
    // {
    //     return $this->_parent;
    // }

    

} ?>