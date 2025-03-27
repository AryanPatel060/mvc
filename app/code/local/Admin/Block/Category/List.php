<?php
// class Admin_Block_Category extends Core_Block_Layout
// {

//     public $verify = [];
//     protected $_collection;
//     public function __construct()
//     {
//         $this->setTemplate('admin/category/list.phtml');
//         $toolbar = $this->getLayout()->createBlock("admin/widget_grid_toolbar");
//         $this->addChild('toolbar', $toolbar);
//         $this->init();
//     }

//     public function init()
//     {
//         $this->getChild('toolbar')->setLimit(3);
//         $this->_collection =  Mage::getModel('catalog/category')
//             ->getCollection();
//         $this->getChild('toolbar')->prepareToolbar();
//         return $this;
//     }

//     public function getCollection()
//     {
//         return $this->_collection
//             ->addFieldToFilter('Parent_id', ['IS NOT' => NULL]);
//     }

//     public function getCategoryData()
//     {
//         $product = $this->getCollection()
//             // ->select('catalog_category.*')
//             ->addFieldToFilter('Parent_id', ['IS NOT' => NULL]);
//         // ->selfJoin('c2 ','c2.category_id = catalog_category.parent_id',['parent_name'=>'name']);
//         return $product->getData();
//     }
// }


class Admin_Block_Category_List extends Admin_Block_Widget_Grid
{
    public $_collection;
    public function __construct()
    {

        $this->setCollection(
            Mage::getModel('catalog/category')
                ->getCollection()
                ->join(
                    ["c2" => "catalog_category"],
                    "c2.category_id = main_table.parent_id",
                    ["parent_name" => "name"]
                )
        );
        $this->addColumn(
            "category_id",
            [
                'type' => "text",
                "label" => "ID",
                "filter" => "number",
                "validation" => "validate-number",
                "data-index" => "category_id",
                "filter-class" => "validate-number",
            ]
        );

        $this->addColumn(
            "name",
            [
                'type' => "text",
                "label" => "Name",
                "filter" => "text",
                "validation" => "validate-name",
                "data-index" => "name",
            ]
        );
        $this->addColumn(
            "description",
            [
                'type' => "text",
                "label" => "Description",
                "filter" => "text",
                "data-index" => "description",
            ]
        );
        $this->addColumn(
            "parent_name",
            [
                'type' => "text",
                "label" => "Parent Category",
                "filter" => "text",
                "data-index" => "parent_name",
            ]
        );
        $this->addColumn(
            "editaction",
            [
                "label" => "Action",
                "button-label" => "Edit",
                "type" => "link",
                "class-list" => "btn btn-primary",
                "link" => "getEditLink"
            ]
        );
        $this->addColumn(
            "deleteaction",
            [
                "label" => "Action",
                "button-label" => "Delete",
                "type" => "link",
                "class-list" => "btn btn-danger ",
                "link" => "getDeleteLink"
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
 
    public function getEditLink($data)
    {
        // mage::log($data);
        return $this->getUrl("admin/category_index/new").'/?id='.$data->getCategoryId();
    }
    public function getDeleteLink($data)
    {
        // mage::log($data);
        return $this->getUrl("admin/category_index/delete").'/?deleteid='.$data->getCategoryId();
    }
    
}
