<?php 
class Catalog_Model_Resource_Product extends Core_Model_Resource_Abstract{
    // protected $_tableName ;
    // protected $_primaryKey;
    // public function init()
    // {
    //     $this->_tableName = 'catalog_product';
    //     $this->_primaryKey = 'product_id';
    // }
    public function _construct()
    {
        $this->init('catalog_product','product_id');
    }

}