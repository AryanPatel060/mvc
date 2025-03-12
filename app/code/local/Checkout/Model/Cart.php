<?php
class Checkout_Model_Cart extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName  = "Checkout_Model_Resource_Cart";
        $this->_collectionClassName  = "Checkout_Model_Resource_Cart_Collection";
    }

    public function addCartItem($data)
    {
        $cartItemModel = Mage::getSingleton('checkout/cart_items');

        $data['cart_id'] = $this->getCartId();
        $productData = Mage::getModel('catalog/product')->load($data['product_id']);
        $data['price'] = $productData->getPrice();
        $data['sub_total'] = $data['price'] * $data['product_quantity'];
        $cartItemModel->setData($data);

        // die();
        $cartItemModel->save();
        return $this;
    }

    public function removeItem($itemId)
    {
        $itemcollection = $this->getItemCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());
        foreach ($itemcollection->getData() as $item) {
            if ($item->getItemId() == $itemId) {
                $item->delete();
            }
        }
        return $this;
    }
    public function updateItem($data)
    {
        $itemcollection = $this->getItemCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());
        foreach ($itemcollection->getData() as $item) {
            if ($item->getItemId() == $data['item_id']) {
                $item->setProductQuantity($data['product_quantity']);
                $item->setSubTotal($data['product_quantity'] * $item->getPrice());

                mage::log($item);
                // die();
                $item->save();
            }
        }
        return $this;
    }


    public function getItemCollection()
    {
        return Mage::getModel('checkout/cart_items')
            ->getCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());
    }
    public function getCoupon()
    {
        return Mage::getModel('checkout/coupon');
    }



    protected function _beforeSave()
    {

        $itemCol = $this->getItemCollection()->select(['sum(main_table.sub_total)' => 'totalAmount']);
        $couponModel = $this->getCoupon();
        $totalAmount = (float)$itemCol->getFirstItem()->getData()['totalAmount'];
        $discount = $couponModel->calculateDiscount($this->getCouponCode(),$totalAmount);
        $this->setCouponDiscount($discount);
        $this->setTotalAmount($totalAmount-$discount);
        $this->setUpdatedAt(date("Y-m-d h:i:s"));
        mage::log($this);
        // print_r($this);
        // die();
        // die();
        return $this;
    }
}
