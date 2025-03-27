<?php
class Catalog_Block_Product_List extends Core_Block_Layout
{

    public $products = [];
    protected $_collection ;
    public function __construct()
    {
        $this->setTemplate('catalog/product/list.phtml');
        $filter = $this->getLayout()->createBlock('catalog/product_list_filter');
        $products = $this->getLayout()->createBlock('catalog/product_list_products');
        $this->addChild('filter',$filter);
        $this->addChild('product',$products);
    }






    public function getProductData()
    {
        // $request = Mage::getModel('core/request');
        // $product = Mage::getModel('catalog/filter')->getProductCollection();
        // $categoryId = $request->getQuery('categoryid');

        // $minprice = $request->getQuery('minprice');
        // $minprice = ($minprice == "")? 1 :$minprice;

        // // die;

        // $product = Mage::getModel('catalog/product')
        //                 ->getCollection()
        //                 ->addFieldToFilter('category_id',$categoryId)
        //                 ->addFieldToFilter('price',['>'=>$minprice]);

        // return (count($this->products))?$product->getData():$this->products;
        $product =$this->_collection;
        return $product->getData();
    }

    public function setFilteredData($data)
    {
        $this->products = $data;
        return $this;
    }
   
    public function getCategoryData()
    {
        $category = Mage::getModel('catalog/category')
            ->getCollection();
        return $category->getData();
    }

    public function getPriceRange()
    {
        $product = Mage::getModel("catalog/product")
            ->getCollection();
        $product->select(['price ']);
        $range = $product->getData();
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

  

    



}
