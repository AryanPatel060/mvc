
<?php 

class Core_Block_Html_Element_Label {
    protected $_data = [];

    public function __construct($data) {
        $this->_data =$data;
    }

    public function render() {
        $html = "<label";
        if(isset($this->_data['for'])) {
            $html .= sprintf(" for='%s'",$this->_data['for']);
        }
        if(isset($this->_data['class'])) {
            $html .= sprintf(" class='%s'",$this->_data['class']);
        }
        $html .= ">";
        $html .= ucfirst($this->_data['for']) . "</label>";

        return $html;
    }
}

?>