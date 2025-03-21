<?php class Admin_Controller_Sales_Order extends Admin_Controller_Account
{
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('admin/sales_order_list');

        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }

    public function viewAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $orderModel = Mage::getModel('sales/order')->load($id);

        $layout = $this->getLayout();
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

    public function updateStatusAction()
    {
        $order = $this->getRequest()->getParam("order");
        $order_id = $this->getRequest()->getParam("order_id");
        $fieldname = $this->getRequest()->getParam("fieldname");
        $value = $this->getRequest()->getParam("value");

        $data = [];
        $data[$fieldname] = $value;
        $data['order_id'] = $order_id;
        $model = Mage::getModel("sales/order")
            ->setData($data)
            ->save();


        Mage::log($model);
        // echo$order_id , $fieldname , $value;
    }
}
