<?php class Admin_Block_Grid_Toolbar extends Core_Block_Layout
{
    protected $_limit = 3;
    protected $_page = 1;
    protected $_collection;
    public function __construct()
    {
        $this->setTemplate('admin/grid/toolbar.phtml');
    }
    public function prepareToolbar()
    {
        $page = $this->getLayout()
            ->getRequest()
            ->getQuery('page');
        $limit = $this->getLayout()
            ->getRequest()
            ->getQuery('limit');

        $this->_limit = (is_numeric($limit)) ? $limit : $this->_limit;
        $this->_page = (is_numeric($page)) ? $page : $this->_page;

        $this->_collection =  clone $this->getParent()->getCollection();

        $this->getParent()->getCollection()->limit($this->_limit)
            ->offset($this->_page);
    }
    public function getTotalRecords()
    {
        // return $this->_collection->select(['count(*)' => 'cnt'])->prepareQuery();
        return count($this->_collection->getData());
    }
}
