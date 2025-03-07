<?php 
class Catalog_Block_Product_Filter extends Core_Block_Layout 
{
    public function __construct()
    {
        $this->setTemplate('catalog/product/filter.phtml');
    }

    public function getBrands()
    {
        $brand = Mage::getModel("catalog/attribute")
            ->getCollection()
            ->addFieldToFilter('attribute_code', 'brand');

        $brandid = $brand->getData()[0]->attribute_id;

        $productAtribute = Mage::getModel('catalog/product_Attribute')
            ->getCollection()
            ->addFieldToFilter('attribute_id', $brandid);

        $brand = [];
        foreach ($productAtribute->getData() as $attribute) {
            if($attribute->getValue() != "")
            {
                $brand[$attribute->getValueId()] = $attribute->getValue();
            }
        }
        return array_unique($brand);


        // $product->select(['*']);
        // echo $product->prepareQuery();
        // return $product->getData();
    }
    

    public function getCategoryData()
    {
        $category = Mage::getModel('catalog/category')
            ->getCollection();
        return $category->getData();
    }

}

?>