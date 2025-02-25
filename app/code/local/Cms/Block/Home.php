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
    public function getImage($productID)
    {
        $media = Mage::getModel('catalog/media')
        ->getCollection()
        ->addFieldToFilter('product_id',$productID);
        $images = $media->getData();
   
        $files = [];
        foreach($images as $image)
        {   
            $image = $image->getData();

            if(strstr($image['file_path'] , 'thumbnail'))
            {
                $files['thumbnail'] = $image['file_path'];
            }
            else {
                $files[''] = $image['file_path'];
            }
        }
        return $files;

        
    }
    
}
