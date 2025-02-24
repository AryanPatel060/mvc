<?php
class Page_Block_Head extends Core_Block_Template
{
    protected $_js = [];
    protected $_css = [];
    public function __construct()
    {
        $this->setTemplate('page/head.phtml');
          
    }
    public function getJs()
    {
        return $this->_js;
    }
    public function getCss()
    {
        return $this->_css;
    }
    public function addJs($js)
    {
        $this->_js[] = $js;
        return $this;
    }
    public function addCss($css)
    {
        $this->_css[] = $css;
        return $this;
    }
    public function removeJs()
    {
        $this->_js = [];
        return $this;
    }
    public function removeCss($css)
    {
        $this->_css = [];
        return $this;
    }
}
