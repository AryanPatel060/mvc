<?php
class Catalog_Controller_Product
{
    public function listAction()
    {
       

        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_list');
        //    print_r($view);

        // $product = Mage::getModel('catalog/product')
        //                 ->getCollection()
        //                 ->addFieldToFilter('category_id',$categoryId);

        // $product->getData();
        
        $layout->getChild('content')->addChild('list', $view);
        $layout->toHtml();
    }
    
    public function viewAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view');
    
        $layout->getChild('content')->addChild('view', $view);
        $layout->toHtml();
    }

    public function testAction()
    {
      
       echo "<pre>";
       $collection = Mage::getModel('catalog/product')->load(21);
                            // ->getCollection();
                            // ->limit(5)
                            // ->addAttributeToSelect(["color" ,"Brand"]);

                            
        print_r($collection->getData());



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
