<?php class Admin_Block_Widget_Grid_Column_Link extends Admin_Block_Widget_Grid_Column_Abstract
{
    protected $_data;
    protected $_row;
    protected $_instance;

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
        $callback = $this->getData()['link'];
        return $this->getInstance()->$callback($this->getRow());
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
                href="' . $this->getLink() . '"
                class="' . $this->getClassList() . '" 
                onclick="return confirm(`Are you sure Want To delete?`)"
                 >
                ' . $this->getBtnLabel() . '
            </a>';
    }
}
