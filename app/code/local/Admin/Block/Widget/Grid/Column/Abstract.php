<?php class Admin_Block_Widget_Grid_Column_Abstract
{
    protected $_row;
    protected $_instance;
    public function render()
    {
        print_r($this->getRow()->getData()[$this->getData()['data-index']]);
    }
    public function getData() {}

    public function getFilter()
    {
        $data = $this->getData();
        if (isset($data['filter'])) {
            $class = "Admin_Block_Widget_Grid_Filter_" . ucfirst($data['filter']);
        } else $class = "Admin_Block_Widget_Grid_Filter_Text";
        $filter = new $class();
        $filter->setData($data);
        return $filter;
    }
    public function getValidation()
    {
        if (isset($this->getData()['validation'])) {
            return $this->getData()['validation'];
        }
        return "";
    }
    public function getClassList()
    {
        if (isset($this->getData()['class-list'])) {
            return $this->getData()['class-list'];
        }
        return "";
    }
    public function setRow($data)
    {
        $this->_row = $data;
        return $this;
    }
    public function getRow()
    {
        return $this->_row;
    }
    public function getLabel()
    {
        echo $this->getData()['label'];
    }
    public function setInstance($instance)
    {
        $this->_instance = $instance;
        return $this;
    }
    public function getInstance()

    {
        return $this->_instance;
    }
}
