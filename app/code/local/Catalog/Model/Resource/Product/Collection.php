<?php
class Catalog_Model_Resource_Product_Collection extends Core_Model_Resource_Collection_Abstract
{
    public function addAttributeToSelect($attributes)
    {
        foreach ($attributes as $attribute) {
            $a =   Mage::getModel('catalog/attribute')
                ->load($attribute, "attribute_code");

            $this->leftJoin(
                ["cpa_{$a->getAttributeCode()}"=>"catalog_product_attribute"],
                "main_table.product_id = cpa_{$a->getAttributeCode()}.product_id AND 
                cpa_{$a->getAttributeCode()}.attribute_id = " . $a->getAttributeId(),
                [$a->getAttributeCode() => "value"]
            );
        }
        return $this;
    }
}
