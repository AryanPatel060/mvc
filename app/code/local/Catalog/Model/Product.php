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
    protected function _afterload()
    {
        if($this->getProductId())
        {
            $data = Mage::getModel('catalog/productAttribute')
            ->getCollection()
            ->leftJoin(["attr"=>"catalog_attribute"],"attr.attribute_id = main_table.attribute_id",["attribute_code"=>"attribute_code"]);

          
            foreach($data->getData() as $_data)
            {
                $this->{$_data->getAttributeCode()} = $_data->getValue();
            }

        }
        return $this;
    }
}
