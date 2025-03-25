<?php class Admin_Block_Widget_Grid_Columns_Link extends Admin_Block_Widget_Grid_Column 
{
    public function __construct()
    {
        $this->setTemplate("admin/widget/column/link.phtml");
    }

    public function getBtnLabel()
    {
        return $this->getData()['button-label'];
    }
    public function getLink()
    {
        return $this->getData()['link'];
    }
    public function getId()
    {
        return $this->getData()['id'];
    }
}?>