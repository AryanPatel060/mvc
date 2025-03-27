<?php class Admin_Block_Widget_Grid_Column_Link extends Admin_Block_Widget_Grid_Column_Abstract
{
    protected $_data;
    protected $_row;

    public function __construct()
    {
        // $this->setTemplate("admin/widget/column/link.phtml");
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

    public function getBtnLabel()
    {
        return $this->getData()['button-label'];
    }
    public function getLink()
    {
        return $this->getData()['link'];
    }
    public function getPrimarykey()
    {
        return $this->getRow()->getResource()->getPrimarykey();
    }
    public function getId()
    {
        return $this->getRow()->{$this->getPrimarykey()};
    }
    public function render()
    {
        return '<a
                href="' . $this->getLink() . '/?id=' . $this->getId() . '"
                class="' . $this->getClassList() . '">
                ' . $this->getBtnLabel() . '
            </a>';
    }
}
