<?php
class Cms_Block_SlideBar extends Core_Block_Layout
{
    public $products = [];
    public function setProducts($data)
    {
        $this->products = $data;
        return $this;
    }
    public function getSliderData($length =10)
    {   
        $product = Mage::getModel('catalog/product')
                    ->getCollection();
        $product->limit($length);
        return $product->getData();
    }
}
