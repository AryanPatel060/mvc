<?php 
class Cms_Block_Home extends Core_Block_Layout {
    public $sliderproduct = [];
    public $slidproduct = [];
    public function setSliderProduct($data)
    {
        $this->sliderproduct = $data;
        return $this;
    }
    public function getBannerProduct()
    {
        
        $product = Mage::getModel('catalog/product')
                        ->getCollection();
        $product->limit(3);
        $data = $product->getData();
        return $data;
    }
    
}
