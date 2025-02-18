<?php
class Admin_Controller_Product_Index
{
    public $data ;
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Product_Index_New');
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();    
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Product_Index_List');
            // ->setTemplate('Admin/Product/Index/List.phtml');
        //    print_r($view);
        
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $layout = Mage::getBlock('core/layout');
        $delete = $layout->createBlock('Admin/Product_Index_Delete')
            ->setTemplate('Admin/Product/Index/Delete.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('delete', $delete);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('Admin/Product_Index_Save')
            ->setTemplate('Admin/Product/Index/Save.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('save', $save);
        $layout->toHtml();
    }
}
