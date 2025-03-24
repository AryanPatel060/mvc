<?php

class Admin_Controller_Category_Index extends Core_Controller_Admin_Action
{
    public function newAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/Category_New');
        $layout->getChild('content')->addChild('newcategory', $new);
        $layout->getChild('head')->addJs('admin/new.js');

        $layout->toHtml();
    }

    public function listAction()
    {
        $list =  $this->getLayout()->createBlock('Admin/Category_list');
        $this->getLayout()->getChild('content')->addChild('list', $list);
        $this->getLayout()->getChild('head')->addJs('admin/new.js');
        $this->getLayout()->toHtml();
    }
    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('deleteid');

        $category = Mage::getModel('catalog/category');
        $category->load($id);
        if ($category->getParentId() == null) {
            $list = Mage::getBlock('admin/category_list');
            $list->setMessage('can\'t delete this Category !!');
            // print_r($list);  
            // die();

            header("location:http://localhost/MVC/admin/category_index/list");
        } else {
            $result = $category->delete();
        }
        if ($result) {
            header("location:http://localhost/MVC/admin/category_index/list");
        } else {
            echo "error in deletion !";
        }
    }
    public function saveAction()
    {
        $category = $this->getRequest()->getParam('category');

        $model = Mage::getModel('catalog/category');
        $model->setData($category);
        $category_id = $model->save();
        if ($category_id) {
            // print_r($category_id) ;
            echo 'saved success';
            header("location:http://localhost/MVC/admin/category_index/list");
        } else {
            echo "insertion error";
        }
    }


    public function exportCategoryAction()
    {
        Mage::getModel("catalog/category")
            ->exportData();
       
    }
}
