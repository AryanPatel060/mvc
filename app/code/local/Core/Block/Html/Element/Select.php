<?php
class Core_Block_Html_Element_Select extends Core_Block_Html_Element_Abstract
{
    public function render()
    {
        $optionsHtml = '';
        if (!empty($this->_data['options']) && is_array($this->_data['options'])) {
            foreach ($this->_data['options'] as $value => $label) {
                $selected = (isset($this->_data['value']) && $this->_data['value'] == $value) ? " selected" : "";
                $optionsHtml .= sprintf("<option value='%s'%s>%s</option>\n", htmlspecialchars($value, ENT_QUOTES), $selected, htmlspecialchars($label, ENT_QUOTES));
            }
        }
        return sprintf("<select%s>\n%s</select>", $this->getAttributeString(), $optionsHtml);
    }
}
