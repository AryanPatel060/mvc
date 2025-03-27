<?php
class Core_Model_Abstract extends Core_Model_Export
{
    protected $_resourceClassName;
    protected $_collectionClassName;

    protected $_data = null;
    public function __construct()
    {
        // echo $this->_resourceClassName;
        $this->init();
    }
    public function init() {}
    public function getResource()
    {
        return new $this->_resourceClassName();
    }

    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
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
    public function removeData()
    {
        $this->_data = null;
        return $this;
    }

    public function __get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : "";
    }

    public function __call($method, $value)
    {
        $get = substr($method, 0, 3);
        $field = substr($method, 3);
        $field = $this->camelToSnake($field);
        if ($get == "get") {
            return isset($this->_data[$field]) ? $this->_data[$field] : "";
        } else if ($get == 'set') {
            $this->_data[$field] = $value[0];
            return $this;
        }
        throw new Exception('error function not found');
    }
    private function camelToSnake($input)
    {

        $snakeCase = preg_replace_callback(
            '/[A-Z]/',
            function ($matches) {
                return '_' . strtolower($matches[0]);
            },
            $input
        );

        return ltrim($snakeCase, '_');
    }

    public function load($value, $field = null)
    {
        $this->_data = $this->getResource()->load($value, $field);
        $this->_afterload();
        return $this;
    }
    public function save()
    {
        $this->_beforeSave();
        // echo "in save befor going in save ";
        // die();

        $this->getResource()->save($this);
        $this->_afterSave();
        return $this;
    }
    public function delete()
    {
        $result = $this->getResource()->delete($this);
        if ($result) {
            return $this;
        } else {
            return false;
        }
    }
    public function getCollection()
    {
        $collection = new $this->_collectionClassName();
        $collection->setResource($this->getResource())
            ->setModel($this)
            ->select();

        return $collection;
    }

    protected function _afterload()
    {
        // return $this;
    }
    protected function _afterSave()
    {
        return $this;
    }
    protected function _beforeSave()
    {
        return $this;
    }

    public function exportData()
    {
        return  $this->setCollection($this->getCollection())
            ->export();
    }
}
