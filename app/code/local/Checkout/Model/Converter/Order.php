<?php class Checkout_Model_Converter_Order
{
    public function convert($cart)
    {
        // order 
        $cartData = $cart->getData();

        unset($cartData['cart_id']);
        // ip address to be added
        // created at updated at to be make new
        // $_SERVER['REMOTE_ADDR'] 

        Mage::log($cartData);
        $order = Mage::getModel("sales/order")
            ->setData($cartData)
            ->setCreatedAt(date("Y-m-d h:i:s"))
            ->setUpdatedAt(date("Y-m-d h:i:s"))
            ->save();


        // order items 
        $orderId = $order->getOrderId();
        $item = $cart->getItemCollection();
        $itemData = $item->getData();
        foreach ($itemData as $item) {
            $item = $item->getdata();
            unset($item['item_id']);
            unset($item['cart_id']);
            $item['order_id'] = $orderId;
            Mage::getModel("Sales/Order_items")
                ->setData($item)
                ->setCreatedAt(date("Y-m-d h:i:s"))
                ->setUpdatedAt(date("Y-m-d h:i:s"))
                ->save();
        }


        // order address 
        $billing = $cart->getBillingAddress()->getData();
        $shipping = $cart->getshippingAddress()->getData();
        unset($billing['address_id']);
        unset($shipping['address_id']);
        $address = Mage::getModel("Sales/order_address");
        $address->setData($billing)
            ->setCreatedAt(date("Y-m-d h:i:s"))
            ->setUpdatedAt(date("Y-m-d h:i:s"))
            ->save();

        $address->setData($shipping)
            ->setCreatedAt(date("Y-m-d h:i:s"))
            ->setUpdatedAt(date("Y-m-d h:i:s"))
            ->save();

    }
}
