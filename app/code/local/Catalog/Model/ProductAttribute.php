<?php
class Catalog_Model_ProductAttribute extends Core_Model_Abstract
{
   
    public function init()
    {
        $this->_resourceClassName  = "Catalog_Model_Resource_ProductAttribute";
        $this->_collectionClassName  = "Catalog_Model_Resource_ProductAttribute_Collection";
    }
}
