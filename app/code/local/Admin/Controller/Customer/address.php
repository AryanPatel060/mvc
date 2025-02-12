<?php 
class Admin_Controller_Customer_Address{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Customer_Address_new')
                       ->setTemplate('Admin/Customer/address/new.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('new',$list);
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Customer_Address_list')
                       ->setTemplate('admin/customer/address/list.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('list',$list);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $layout = Mage::getBlock('core/layout');
        $delete = $layout->createBlock('Admin/Customer_Address_delete')
                       ->setTemplate('admin/customer/address/delete.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('delete',$delete);
        $layout->toHtml();

    }
    public function saveAction()
    {
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('Admin/Customer_Address_save')
                       ->setTemplate('admin/customer/address/save.phtml');
                    //    print_r($view);
        $layout->getChild('content')->addChild('save',$save);
        $layout->toHtml();
    }
}