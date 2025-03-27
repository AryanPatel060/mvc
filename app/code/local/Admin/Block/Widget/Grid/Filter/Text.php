<?php class Admin_Block_Widget_Grid_Filter_Text extends Admin_Block_Widget_Grid_Filter_Abstract
{
    protected $_data;
    public function __construct()
    {
                // $this->setTemplate("admin/Widget/filter/text.phtml");
    }

    public function render()
    {   
        if(isset($this->_data['data-index'] ))
        {

            return '<div class="mb-3">
            <input
            class="form-control' . $this->getClassList() ." ". $this->getValidation() . '"
            type="text"
            id="filter-' . $this->_data['data-index'] . '"
            placeholder="' . $this->_data['label'] . '"
            value=""
            >
            </div>';
            }
            else return "";
    }
    public function setData($data)
    {   
        $this->_data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->_data;
    }
}
