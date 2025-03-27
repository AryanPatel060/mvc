<?php class Admin_Block_Widget_Grid extends Core_Block_Template
{

    protected $_columns = [];
    protected $_collection;
    protected $_data;

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


    public function addColumn($key, $data)
    {
        $class = "Admin_Block_Widget_Grid_Column_" . ucfirst($data['type']);
        $object = new $class;
        $this->_columns[$key] = $object;
        $object->setData($data);
        return $this;
    }



    public function renderFilter($data)
    {
        if (isset($data['filter'])) {
            $class = "Admin_Block_Widget_Grid_Filter_" . ucfirst($data['filter']);
            $filter = new $class();
            $filter->setData($data);
            return $filter->toHtmlTag();
        } else return "";
    }


    public function renderButton($data, $id = "")
    {
        $class = "Admin_Block_Widget_Grid_Columns_" . ucfirst($data['type']);
        $buttons = new $class();
        $data['id'] = $id;
        $buttons->setData($data);
        return $buttons->toHtmlTag();
    }

    public function renderColumn($data)
    {
        if (isset($data['type']) && $data['type'] == "text") {
            $class = "Admin_Block_Widget_Grid_Column_" . ucfirst($data['type']);
            $column = new $class();
            // echo ($class);
            $column->setData($data);
            return $column->toHtmlTag();
        } else return "";
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
        $ignore = ['page','limit'];
        foreach ($parameters as $field => $parameter) {
            if(is_array($parameter) )
            {
                if(isset($parameter['from']) && $parameter['from'] != "" )
                {
                   $this->_collection->addFieldToFilter('main_table.'.$field, [">=" =>$parameter['from']]);
                }
                if(isset($parameter['to']) && $parameter['to'] != "" )
                {
                   $this->_collection->addFieldToFilter('main_table.'.$field, ["<=" =>$parameter['to']]);
                }
                
            }
            else if( !in_array($field , $ignore))
            {
                $this->_collection->addFieldToFilter('main_table.'.$field, ["LIKE" =>$parameter]);
            }

        
        }
    }
}
