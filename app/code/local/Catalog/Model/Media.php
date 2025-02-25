<?php
class Catalog_Model_Media extends Core_Model_Abstract
{
   
    public function init()
    {
        $this->_resourceClassName  = "Catalog_Model_Resource_Media";
        $this->_collectionClassName  = "Catalog_Model_Resource_Media_Collection";
    }
}
