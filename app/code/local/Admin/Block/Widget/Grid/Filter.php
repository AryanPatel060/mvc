<?php class Admin_Block_Widget_Grid_Filter extends Admin_Block_Widget_Grid {

protected $_data;

public function setData($data)
{
    $this->_data = $data;
    return $this;
}

public function getData()
{
    return $this->_data ;
}

} 