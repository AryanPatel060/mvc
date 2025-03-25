<?php class Admin_Block_Widget_Grid_Columns_Text extends Admin_Block_Widget_Grid_Column 
{
    public function __construct()
    {
       
        $this->setTemplate("admin/Widget/column/text.phtml");
    }
    public function getLabel()
    {
        return $this->_data['label'];
    }
}?>