<?php
class Core_Block_Html_Element_Input extends Core_Block_Html_Element_Abstract
{
    public function render()
    {
        $type = $this->_data['type'] ?? 'text'; // Default type is text
        return sprintf("<input type='%s'%s >\n", htmlspecialchars($type, ENT_QUOTES), $this->getAttributeString());
    }
}
