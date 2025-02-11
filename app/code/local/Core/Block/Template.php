<?php
class Core_Block_Template
{
    protected $_child = [];
    protected $_template ;

    public function toHtml()
    {
        include_once(Mage::getBaseDir() . 'app/design/frontend/template/' . $this->_template);
    }
    public function addChild($key, $block)
    {
        $this->_child[$key] = $block;
        return $this;
    }
    public function removeChild($key)
    {
        $this->_child[$key];
        return $this;
    }
    public function getChild($key)
    {
        return isset($this->_child[$key]) ? $this->_child[$key] : "";
    }
    public function getChildHtml($key)
    {
        echo "<pre>";
        print_r($this->_child);
        return isset($this->_child[$key]) ? $this->_child[$key]->toHtml() : "";
    }
    public function setTemplate($template)
    {
        $this->_template = $template;
        return $this;
    }
}
