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

    protected function _getDbColumns()
    {
        $sql = "SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_NAME = N'{$this->_tableName}'";
        return $this->getAdapter()->fetchCol($sql);
    }
    public function load($value, $field = NULL)
    {
        $field = (is_null($field)) ? $this->_primaryKey : $field;
        $sql = "SELECT * FROM `{$this->_tableName}` WHERE {$field} = '{$value}' LIMIT 1";
        return $this->getAdapter()->fetchRow($sql);
    }
    public function save($model)
    {
        // print_r($model);
        $dbColumns = $this->_getDbColumns();
        // print_r($dbColumns);
        // // die();
        $data = $model->getData();
        $primaryId = 0;
        if (isset($data[$this->_primaryKey]) &&  $data[$this->_primaryKey]) {
            $primaryId = $data[$this->_primaryKey];
        }
        if ($primaryId) {
            $sql = "UPDATE {$this->_tableName} SET ";
            unset($data[$this->_primaryKey]);
            $columns = [];
            foreach ($data as $field => $value) {
                // echo($value);
                if (in_array($field, $dbColumns)) {
                    $value = ($value != null) ? $value : "";
                    $columns[] = sprintf("`{$field}` = '%s'", addslashes($value));
                }
            }
            $sql .= implode(', ', $columns);
            $sql .= " WHERE {$this->_primaryKey} = {$primaryId} ";
            return $this->getAdapter()->query($sql);
        } else {

            $sql = "INSERT INTO `{$this->_tableName}`  ";
            $columns = [];
            $values = [];
            foreach ($data as $field => $value) {

                if (in_array($field, $dbColumns)) {
                    $columns[] = "`{$field}`";
                    $values[] = sprintf("'%s'", addslashes($value));
                }
            }
            $sql .= "(" . implode(',', $columns) . ") VALUES";
            $sql .= "(" . implode(',', $values) . ")";

            $insertId = $this->getAdapter()->insert($sql);

            $model->{$this->_primaryKey} = $insertId;
            return $insertId;
        }
    }
    public function delete($model)
    {
        $data = $model->getData();
        $sql = "DELETE FROM {$this->_tableName} WHERE {$this->_primaryKey} = '{$data[$this->_primaryKey]}'";
        $result = $this->getAdapter()->query($sql);
        if ($result) {
            $model->removeData();
        } else {
            echo "delete error";
        }
        return $result;
    }
    public function getTableName()
    {
        return $this->_tableName;
    }
}
