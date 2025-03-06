<?php
class Catalog_Model_Filter extends Core_Model_Abstract
{
    public function getProductCollection()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection();
        $this->applyFilter($collection);
        return $collection;
    }

    public function applyFilter($collection)
    {
        $request = Mage::getSingleton('core/request');
        $parameter = $request->getQuery();

        // echo "<pre>";
        // var_dump($parameter);
        // die();
        if (isset($parameter['cid'])) {
            $collection->addCategoryFilter($parameter['cid']);
            unset($parameter['cid']);
        }
        if (isset($parameter['minprice']) && strlen($parameter['minprice'])) {
            $collection->addFieldToFilter('price', ['>' => $parameter['minprice']]);
            unset($parameter['minprice']);
        }
        if (isset($parameter['maxprice']) && strlen($parameter['maxprice'])) {
            $collection->addFieldToFilter('price', ['<' => $parameter['maxprice']]);
            unset($parameter['maxprice']);
        }
        if (count($parameter) > 0) {

            $attributes = Mage::getModel('catalog/attribute')
                ->getCollection()
                ->addFieldToFilter('attribute_code', ["IN" => array_keys($parameter)]);

            foreach ($attributes->getData() as $attribute) {
                if($parameter[$attribute->getAttributeCode()] !== "")
                {
                    $collection->addAttributeToFilter($attribute->getAttributeCode(), $parameter[$attribute->getAttributeCode()]);
                }
            }
        }
    }
}
