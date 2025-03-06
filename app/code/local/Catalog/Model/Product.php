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
    protected function _afterSave()
    {
        // print_r($this);
        $attributes = Mage::getModel('catalog/attribute')
            ->getCollection();

        foreach ($attributes->getData() as $_attribute) {
            $productAttributes = Mage::getModel('catalog/productAttribute')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->addFieldToFilter('attribute_id', $_attribute->getAttributeId())
                ->getData();
                $value = $this->{$_attribute->getAttributeCode()};
                
                // print_r($productAttributes);
                // die();
            if (isset($productAttributes[0])) {
                $productAttributes[0]->setValue($value)
                    ->save();
            } else {
                Mage::getModel('catalog/productAttribute')
                    ->setAttributeId($_attribute->getAttributeId())
                    ->setProductId($this->getProductId())
                    ->setValue($value)
                    ->save();
            }   
            // print_r($productAttributes);
            // die();
        }

    }
    protected function _afterload()
    {
        if ($this->getProductId()) {
            $data = Mage::getModel('catalog/productAttribute')
                ->getCollection()
                ->addFieldToFilter('main_table.product_id' , $this->getProductId())
                ->leftJoin(["attr" => "catalog_attribute"], "attr.attribute_id = main_table.attribute_id", ["attribute_code" => "attribute_code"]);

                // echo "<pre>";
                
                foreach ($data->getData() as $_data) {
                    $this->{$_data->getAttributeCode()} = $_data->getValue();
                }
                // die();

            // print_r($this);
        }
        return $this;
    }
}
