<?php
class Core_Model_Resource_Abstract
{
    protected $_tableName;
    protected $_primaryKey;
    public function __construct()
    {
        $this->_construct();
    }
    public function _construct()
    {
        return $this;
    }
    public function init($tableName, $primaryKey)
    {
        $this->_tableName = $tableName;
        $this->_primaryKey = $primaryKey;
    }
    public function getAdapter()
    {
        return new Core_Model_DB_Adapter();
    }
    public function load($value)
    {
        $sql = "SELECT * FROM {$this->_tableName} WHERE {$this->_primaryKey} = '{$value}' LIMIT 1";
        return $this->getAdapter()->fetchRow($sql);
    }
    public function getTableName()
    {
        return $this->_tableName;
    }
}
