<?php
class Core_Block_Html_Element_Textarea extends Core_Block_Html_Element_Abstract
{
    public function render()
    {
        $content = $this->_data['value'] ?? '';
        unset($this->_data['value']); 
        return sprintf("<textarea%s>%s</textarea>\n", $this->getAttributeString(), htmlspecialchars($content, ENT_QUOTES));
    }
}
