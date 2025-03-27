<?php
// class Admin_Block_Product_Index_List extends Core_Block_Template
// {
//     public $data = [];
//     protected $_collection;
//     public function __construct()
//     {
//         $this->setTemplate('Admin/Product/Index/List.phtml');
//         $toolbar = $this->getLayout()->createBlock("admin/widget_grid_toolbar");
//         $this->addChild('toolbar', $toolbar);
//         $this->init();
//     }

//     public function init()
//     {
//         $this->_collection =  Mage::getModel('catalog/product')
//             ->getCollection();
//         $this->getChild('toolbar')->prepareToolbar();
//         return $this;
//     }

//     public function getCollection()
//     {
//         return $this->_collection;
//     }

//     public function getProductData()
//     {
//         $product = $this->getCollection()
//             ->addAttributeToSelect(['color', 'brand', 'material', 'releasedate', 'madein'])
//             ->leftJoin(['cat' => 'catalog_category'], 'cat.category_id = main_table.category_id', ['category_name' => 'name']);
//         return $product->getData();
//     }

//     public function getAttributeData()
//     {
//         $attribute = Mage::getModel('catalog/attribute')
//             ->getCollection();
//         return $attribute->getData();
//     }
// }


class Admin_Block_Product_Index_List extends Admin_Block_Widget_Grid 
{
    public $_collection;
    public function __construct()
    {

        $this->setCollection(
            Mage::getModel("catalog/product")
                ->getCollection()
                ->addAttributeToSelect(['color', 'brand', 'material', 'releasedate', 'madein'])
                ->leftJoin(['cat' => 'catalog_category'], 'cat.category_id = main_table.category_id', ['category_name' => 'name'])
        );
        $this->applyFilter();
        $this->addColumn(
            "product_id",
            [
                "label" => "Id",
                "type" => "text",
                "filter" => "number",
                "data-index" => "product_id",
            ]
        );
        $this->addColumn(
            "name",
            [
                "label" => "Name",
                "type" => "text",
                "filter" => "text",
                "data-index" => "name",
            ]
        );
        $this->addColumn(
            "description",
            [
                "label" => "Description",
                "type" => "text",
                "filter" => "text",
                "data-index" => "description",
            ]
        );
        $this->addColumn(
            "price",
            [
                "label" => "Price",
                "type" => "text",
                "filter" => "number",
                "data-index" => "price",
            ]
        );
        $this->addColumn(
            "stock_quantity",
            [
                "label" => "Stocks",
                "type" => "text",
                "filter" => "number",
                "data-index" => "stock_quantity",
            ]
        );
        $this->addColumn(
            "category_id",
            [
                "label" => "Category",
                "type" => "text",
                "filter" => "dropdown",
                "option" => $this->getCategoryData(),
                "data-index" => "category_name",
            ]
        );
        $this->addColumn(
            "editaction",
            [
                "label" => "Action",
                "button-label" => "Edit",
                "type" => "link",
                "class-list" => "btn btn-primary",
                "link" => $this->getUrl("admin/product_index/new")
            ]
        );
        $this->addColumn(
            "deleteaction",
            [
                "label" => "Action",
                "button-label" => "Delete",
                "type" => "link",
                "class-list" => "btn btn-danger ",
                "link" => $this->getUrl("admin//")
            ]
        );


        parent::__construct();
    }

    public function getCategoryData()
    {
        $category = Mage::getModel('catalog/category')
            ->getCollection();

        return $category->getData();
    }
    // public function applyfilter()
    // {
    //     $this->getCollection()
    //         ->addFieldToFilter(
    //             "main_table.product_id",
    //             $this->getLayout()->getRequest()->getQuery('product_id')
    //         );
    // }
}