<?php class Admin_Controller_Sales_Order extends Admin_Controller_Account
{
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/sales_order_list');

        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }

    public function viewAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $orderModel = Mage::getModel('sales/order')->load($id);

        $layout = Mage::getBlock('core/layout');
        $order = $layout->createBlock('admin/sales_order');
        $order->setOrder($orderModel);

        $details = $layout->createBlock('admin/sales_order_details');
        $order->addChild('details', $details);

        $address = $layout->createBlock('admin/sales_order_address');
        $order->addChild('address', $address);
        
        $items = $layout->createBlock('admin/sales_order_items');
        $order->addChild('items', $items);
        
        $layout->getChild('content')->addChild('order', $order);
        $layout->toHtml();
    }
}
