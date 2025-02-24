<?php 
class Cms_Block_Home extends Core_Block_Layout {
    public $sliderproduct = [];
    public $slidproduct = [];
    public function setSliderProduct($data)
    {
        $this->sliderproduct = $data;
        return $this;
    }
    public function setSlidProduct($data)
    {
        $this->slidproduct = $data;
        return $this;
    }
}
