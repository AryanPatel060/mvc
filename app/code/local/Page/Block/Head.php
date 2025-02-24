<?php
class Page_Block_Head extends Core_Block_Template
{
    protected $_js = [];
    protected $_css = [];
    protected $_link = [];
    protected $_script = [];
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
    public function getLink()
    {
        return $this->_link;
    }
    public function getScript()
    {
        return $this->_link;
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
    public function addLink($link)
    {
        $this->_link[] = $link;
        return $this;

    }
    public function addScript($script)
    {
        $this->_script[] = $script;
        return $this;

    }
}
