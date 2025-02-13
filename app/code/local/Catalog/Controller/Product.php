<?php
class Catalog_Controller_Product 
{
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_list')
                       ->setTemplate('catalog/product/list.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('list',$view);
        $layout->toHtml();
    }
    public function viewAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view')
                       ->setTemplate('catalog/product/view.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('view',$view);
        $layout->toHtml();
    }
}
