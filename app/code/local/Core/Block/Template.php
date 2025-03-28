<?php
class Core_Block_Template
{
    protected $_child = [];
    protected $_template;
    protected $_parent = null;

    public function toHtml()
    {
        include_once(Mage::getBaseDir() . 'app/design/frontend/template/' . $this->_template);
    }

    public function toHtmlTag()
    {
        include(Mage::getBaseDir() . 'app/design/frontend/template/' . $this->_template);
    }
    
    public function getParent()
    {
        return $this->_parent;
    }

    public function setParent($parent)
    {
        $this->_parent = $parent;
        return $this;
    }

    public function addChild($key, $block)
    {
        $block->setParent($this);
        if (!isset($this->_child[$key])) {
            $this->_child[$key] = $block;
        }
        return $this;
    }
    public function removeChild($key)
    {
        unset($this->_child[$key]);
        return $this;
    }
    public function getChild($key)
    {
        return isset($this->_child[$key]) ? $this->_child[$key] : "";
    }
    public function getChildHtml($key)
    {
        if ($key == "" && count($this->_child)) {
            $html = "";
            foreach ($this->_child as $child) {
                $html .= $child->toHtml();
            }
            return $html;
        }
        return isset($this->_child[$key]) ? $this->_child[$key]->toHtml() : "";
    }
    public function setTemplate($template)
    {
        $this->_template = $template;
        return $this;
    }
    public function getUrl($url)
    {
        if ($url == "") {
            return Mage::getBaseUrl();
        }
        $url = explode('/', $url);
        $request = Mage::getModel('core/request');

        $_url = [];
        $_url[] = ($url[0] == '*') ? $request->getModuleName() : $url[0];
        $_url[] = ($url[1] == '*') ? $request->getControllerName() : $url[1];
        $_url[] = ($url[2] == '*') ?  $request->getActionName() : $url[2];
        return Mage::getBaseUrl() . implode("/", $_url);
    }
    public function getHtmlField($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $className = sprintf("Core_Block_Html_Element_%s", $field);
        $element = new $className($data);
        return $element->render();
    }
    public function getImageUrl($url)
    {
        return  Mage::getBaseUrl() . $url;
    }
    public function getLayout()
    {
        return Mage::getBlockSinglton('core/layout');
    }

    public function getMessage()
    {
        return Mage::getSingleton('core/message');
    }

    public function getRequest()
    {
        return Mage::getModel('core/request');
    }

    // public function addJs($path)
    // {
    //     echo($path);
    //     return $this;
    // }
    // public function addCss($path)
    // {
    //     echo($path);
    //     return $this;
    // }
}
