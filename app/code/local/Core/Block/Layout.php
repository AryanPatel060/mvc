<?php
class Core_Block_Layout extends Core_Block_Template
{ 
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
                ->addCss('page/common.css');
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


}
