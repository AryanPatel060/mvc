<?php
abstract class Core_Block_Html_Element_Abstract
{
    protected $_data = [];

    public function __construct($data = [])
    {
        $this->_data = $data;
    }

    protected function getAttributeString()
    {
        $attributes = '';
        foreach ($this->_data as $key => $value) {
            if ($key !== 'type' && $key !== 'options') { 
                $attributes .= sprintf(" %s='%s'", htmlspecialchars($key, ENT_QUOTES), htmlspecialchars($value, ENT_QUOTES));
            }
        }
        return $attributes;
    }

    abstract public function render();
}
