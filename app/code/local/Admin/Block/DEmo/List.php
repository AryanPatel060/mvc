<?php class Admin_Block_Demo_List extends Admin_Block_Widget_Grid
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

        $this->addColumn(
            "product_id",
            [
                "label" => "Id",
                "type" => "text",
                "filter" => "text",
                "data-index" => "product_id",
            ]
        );
        $this->addColumn(
            "name",
            [
                "label" => "Name",
                "type" => "text",
                "filter" => "number",
                "data-index" => "name",
            ]
        );
        $this->addColumn(
            "description",
            [
                "label" => "Description",
                "type" => "text",
                "filter" => "number",
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
}
