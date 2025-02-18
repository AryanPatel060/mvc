<?php
class Catalog_Model_Product extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName  = "Catalog_Model_Resource_Product";
        $this->_collectionClassName  = "Catalog_Model_Resource_Product_Collection";
    }
}
