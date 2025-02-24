<?php 
class Cms_Block_SlideBar extends Core_Block_Layout
{
    public $products = [];
    public function setProducts($data)
    {
        $this->products = $data;
        return $this;
    }
}