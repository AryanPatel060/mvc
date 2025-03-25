<?php class Admin_Block_Widget_Grid_Filter_Dropdown extends Admin_Block_Widget_Grid_Filter 
{
    public function __construct()
    {
        $this->setTemplate("admin/Widget/filter/dropdown.phtml");
    }

    public function getOption()
    {
        return $this->getData()['option'];
    }
}?>