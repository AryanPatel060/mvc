<?php
class Core_Block_Layout extends Core_Block_Template
{ 
    public $messages = [];
    protected $_js = [];
    protected $_css = [];
    public function __construct() {
        $this->prepareChildren();
        $this->prepareJsCss();
        $this->_template = 'page/root.phtml';
        
    }
    public function prepareChildren()
    {
        $head = $this->createBlock('page/head');
        $this->addChild('head',$head);
        $header = $this->createBlock('page/header');
        $this->addChild('header',$header);
        $content = $this->createBlock('page/content');
        $this->addChild('content',$content);
        $footer = $this->createBlock('page/footer');
        $this->addChild('footer',$footer);
    }

    public function prepareJsCss(){
        $head = $this->getChild('head')
                ->addJs('page/common.js')
                ->addJs('page/bootstrap.js')
                ->addCss('page/bootstrap.css')
                ->addCss('page/common.css')
                ->addLink('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css')
                ->addScript('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js')
                ->addLink('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

                // ->addCss('page/common.css');
    }
    // public function addJs($js)
    // {
    //     $this->_js[] = $js;
    //     return $this;
    // }
    // public function addCss($css)
    // {
    //     $this->_css[] = $css;
    //     return $this;
    // }


    public function createBlock($block)
    {
        return Mage::getBlock($block);
    }
    public function getCoverImage($productID)
    {
        $media = Mage::getModel('catalog/media_gallery')
            ->getCollection()
            ->addFieldToFilter('product_id',$productID)
            ->addFieldToFilter('cover_image',1);
        
        return $images = $media->getData()[0]->getFilePath();
    }
    public function getImage($productID)
    {
        $media = Mage::getModel('catalog/media_gallery')
        ->getCollection()
        ->addFieldToFilter('product_id',$productID);
        $images = $media->getData();
        $files = [];
        foreach($images as $image)
        {   
            $image = $image->getData();
            if($image['cover_image'] == 1)
            {
                $files['thumbnail'] = $image['file_path'];
            }
            else {
                $files[] = $image['file_path'];
            }
        }
        return $files;
    }
    public function setMessage($msg)
    {
        $this->messages[] = $msg ;
        return $this;
    }

}
