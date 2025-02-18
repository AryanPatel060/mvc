<?php
class Core_Model_Resource_Collection_Abstract 
{
    protected $_resource;
    protected $_model;
    protected $_select = [];

    public function setResource($resource)
    {

        $this->_resource = $resource;
        return $this;
    }
    public function setModel($model)
    {
        // $this->select();
        $this->_model = $model;
        return $this;
    }



    public function select()
    {
        $this->_select['FROM'] = $this->_resource->getTableName();
        $this->_select['COLUMNS'] = ['*'];
        // $this->getdata();

    }

    public function getData()
    {
        $query = sprintf("SELECT %s FROM %s" , $this->_select['COLUMNS'][0] , $this->_select['FROM']);
        $data = $this->_resource->getAdapter()->fetchAll($query);
        
        foreach($data as &$_data)
        {
           $obj = new $this->_model;
           $_data = $obj->setData($_data);

        }
        // die();
        return $data;

    }
}
