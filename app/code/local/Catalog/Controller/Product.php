<?php
class Catalog_Controller_Product extends Core_Controller_Front_Action
{
    public function listAction()
    {
        $layout = Mage::getBlockSinglton('core/layout');
        $list = $layout->createBlock('catalog/product_list');

        $content = $layout->getChild('content');
        $content->addChild('list', $list);
        if ($this->getRequest()->isAjax()) {    
            $layout->removeChild('header');
            $layout->removeChild('footer');
            $layout->removeChild('head');
            $product = $layout->getChild('content')->getChild('list')->getChild('product');
            $layout->getChild('content')->removeChild('list');
            $layout->getChild('content')->addChild('product', $product);
            // ->removeChild('filter');

        }
        $layout->toHtml();
    }
    public function viewAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view');

        $layout->getChild('content')->addChild('view', $view);
        $layout->getChild('head')->addJs('page/viewproduct.js');
        $layout->toHtml();
    }

    public function testAction()
    {

        // echo "<pre>";
        // //    $collection = Mage::getModel('catalog/product')
        // //                         ->getCollection()
        // //                         ->addAttributeToSelect(["color" ,"Brand"]);
        // $col = Mage::getModel('checkout/cart_items')
        //     ->getCollection();
        // print_r($col->getData());
        // // $collection = $col->getProductCollection();

        // print_r($collection->prepareQuery());

        $item = Mage::getSingleton("checkout/session")
            ->getCart()
            ->getItemCollection();
        $item->select(['sum(main_table.sub_total)' => 'subTotal', 'item_id']);
    }
}


//   // $layout = Mage::getBlock('core/layout');
//   echo "<pre>";
//   $product = Mage::getModel('catalog/product')
//       ->load(35);
//       // ->addFieldToFilter('product_id',15);
//       // ->leftJoin('catlog_category', 'catlog_category.category_id  = catlog_product.category_id', ['category_name' => 'name']);
//   // ->orderBy(['product_id DESC','price'])
//   // ->groupBy(['product_id','price'])
//   // ->having('product_id',['>'=>34])
//   // ->having('columnname',15);
  
//   print_r($product);
//   $product = Mage::getModel('catalog/product');
//   print_r($product);

//   $sin = Mage::getSingleton('catalog/product')->load(35);
//   $product = Mage::getSingleton('catalog/product');
//   print_r($product);
//   print_r($sin);
//   $product->setName( 'hyy');;
//   echo $sin->getName();
