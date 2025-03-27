<?php class Admin_Block_Widget_Grid extends Core_Block_Template
{

    protected $_columns = [];
    protected $_collection;
    protected $_data;
    protected $_title = [
        "Product",
        "Category",
        "Order",
    ];

    public function __construct()
    {
        $this->setTemplate("admin/widget/grid.phtml");
        $toolbar = $this->getLayout()->createBlock("admin/widget_grid_toolbar");
        $this->addChild('toolbar', $toolbar);
        $this->init();
    }
    // $this->init();

    public function init()
    {
        $this->getChild('toolbar')->prepareToolbar();
        return $this;
    }

    public function getTitle()
    {
        // echo strstr(get_class($this),"Category");
        foreach ($this->_title as $title) {
            if (strstr(get_class($this), $title)) {

                return $title . " List";

            } 
        }
        return "List";
    }

    public function addColumn($key, $data)
    {
        $class = "Admin_Block_Widget_Grid_Column_" . ucfirst($data['type']);
        $object = new $class;
        $this->_columns[$key] = $object;
        $object->setData($data);
        $object->setInstance($this);
        return $this;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function getCollection()
    {

        return $this->_collection;
    }
    public function setCollection($collection)
    {
        $this->_collection = $collection;
        return $this;
    }
    public function getFilter()
    {
        if (isset($this->getData()['filter'])) {
            return $this->getData()['filter'];
        }
        return "";
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
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->_data;
    }
    public function getPrimarykey()
    {
        return $this->getCollection()->getResource()->getPrimarykey();
    }

    public function applyFilter()
    {
        // $request = Mage::getSingleton('core/request');
        $parameters = $this->getRequest()->getQuery();
        $ignore = ['page', 'limit'];
        foreach ($parameters as $field => $parameter) {
            if (is_array($parameter)) {
                if (isset($parameter['from']) && $parameter['from'] != "") {
                    $this->_collection->addFieldToFilter('main_table.' . $field, [">=" => $parameter['from']]);
                }
                if (isset($parameter['to']) && $parameter['to'] != "") {
                    $this->_collection->addFieldToFilter('main_table.' . $field, ["<=" => $parameter['to']]);
                }
            } else if (!in_array($field, $ignore)) {
                $this->_collection->addFieldToFilter('main_table.' . $field, ["LIKE" => $parameter]);
            }
        }
    }
}
