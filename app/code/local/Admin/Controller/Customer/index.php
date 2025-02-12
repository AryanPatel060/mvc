<?php 
class Admin_Controller_Customer_Index{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Customer_Index_New')
                       ->setTemplate('Admin/Customer/Index/new.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('new',$new);
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Customer_Index_List')
                       ->setTemplate('Admin/Customer/Index/list.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('list',$list);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $layout = Mage::getBlock('core/layout');
        $delete = $layout->createBlock('Admin/Customer_Index_Delete')
                       ->setTemplate('Admin/Customer/Index/delete.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('delete',$delete);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('Admin/Customer_Index_Save')
                       ->setTemplate('Admin/Customer/Index/save.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('save',$save);
        $layout->toHtml();
    }
}