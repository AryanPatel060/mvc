<?php
class Core_Block_Layout extends Core_Block_Template
{ 

    public function __construct() {
        $this->prepareChildren();
        $this->_template = 'page/root.phtml';
        
    }
    public function prepareChildren()
    {
        $header = $this->createBlock('page/header');
        $this->addChild('header',$header);
        $content = $this->createBlock('page/content');
        $this->addChild('content',$content);
        $footer = $this->createBlock('page/footer');
        $this->addChild('footer',$footer);
    }


    public function createBlock($block)
    {
        return Mage::getBlock($block);
    }


}
