<?php
class Cms_Controller_Index extends Core_Controller_Front_Action{

    public function __construct()
    {
        
    }
    public function indexAction()
    {
        
        $layout = Mage::getBlock('core/layout');
        $home = $layout->createBlock('cms/Home')
                         ->setTemplate('cms/home.phtml');
        $slidebar = $layout->createBlock('cms/slidebar')
                         ->setTemplate('cms/slidebar.phtml');
        
        $product = Mage::getModel('catalog/product')
                        ->getCollection();
        $product->limit(3);
        $data = $product->getData();
        $home->setSliderProduct($data); 
        
        $product->limit(10);
        $products = $product->getData();
        $slidebar->setProducts($products);
            
        
        $layout->getChild('content')->addChild('home', $home)
                                    ->addChild('slidebar',$slidebar);
        
        
        
        // <----------------have to add swipper.js and  required files to slider.phtml------------>
        //     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        //     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        // $layout->getChild('head')
        // ->addJs('cms/swipper.js')
        // ->addJs('cms/slider.js');
        // <---------------------------------------------------------->

        $layout->toHtml();
    }
}