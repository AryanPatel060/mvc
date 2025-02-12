<?php 
class Catalog_Model_Resource_Product{
    protected $_tableName ;
    protected $_primaryKey;
    public function init()
    {
        $this->_tableName = 'catalog_product';
        $this->_primaryKey = 'product_id';
    }
}