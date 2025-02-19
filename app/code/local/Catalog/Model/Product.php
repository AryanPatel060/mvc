<?php
class Catalog_Model_Product extends Core_Model_Abstract
{
    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];
    public function init()
    {
        $this->_resourceClassName  = "Catalog_Model_Resource_Product";
        $this->_collectionClassName  = "Catalog_Model_Resource_Product_Collection";
    }
    public function getStatusText()
    {
        if (isset($this->status[$this->getStatus()])) {
            return $this->status[$this->getStatus()];
        } else {
            return "NA";
        }
        
    }
}
