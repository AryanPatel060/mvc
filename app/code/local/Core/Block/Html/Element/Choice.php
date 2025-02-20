<?php
class Core_Block_Html_Element_Choice extends Core_Block_Html_Element_Abstract
{
    public function render()
    {
        $type = $this->_data['type'] ?? 'radio'; // Default type is radio
        $name = $this->_data['name'] ?? '';
        $selectedValues = isset($this->_data['value']) ? (array) $this->_data['value'] : []; // Ensure array for multiple selection
        $options = $this->_data['options'] ?? [];

        $html = '';
        foreach ($options as $value => $label) {
            $checked = in_array($value, $selectedValues) ? " checked" : "";
            $id = $name . $value; // Generate unique ID

            $html .= sprintf(
                "<label for='%s'><input type='%s' id='%s' name='%s' value='%s'%s %s /> %s</label><br>",
                htmlspecialchars($id, ENT_QUOTES),
                htmlspecialchars($type, ENT_QUOTES),
                htmlspecialchars($id, ENT_QUOTES),
                htmlspecialchars($name, ENT_QUOTES),
                htmlspecialchars($value, ENT_QUOTES),
                $this->getAttributeString(),
                $checked,
                htmlspecialchars($label, ENT_QUOTES)    
            );
        }

        return $html;
    }
}
