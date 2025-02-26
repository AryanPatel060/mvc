<?php 

class Admin_Controller_Category_Index extends Core_Controller_Front
{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Category_New');
        $layout->getChild('content')->addChild('newcategory',$new);
        $layout->toHtml();
    }   

    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Category_list');
        $layout->getChild('content')->addChild('list',$list);
        $layout->toHtml();
    }   
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('deleteid');

        $category = Mage::getModel('catalog/category');
        $category->load($id);   
        if($category->getParentId() == null)
        {
            $list = Mage::getBlock('admin/category_list');
            $list->setMessage('can\'t delete this Category !!');
            print_r($list);
            // die();
           
            header("location:http://localhost/MVC/admin/category_index/list");
        }
        else {   
            $result = $category->delete();
        }
            if($result)
            {
                header("location:http://localhost/MVC/admin/category_index/list");
            }
            else 
            {
                echo "error in deletion !";
            }
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $category = $request->getParam('category');

        $model = Mage::getModel('catalog/category');
        $model->setData($category);
        $category_id = $model->save();
        if($category_id)
        {
            print_r($category_id) ;
            echo 'saved success';
            header("location:http://localhost/MVC/admin/category_index/list");
        }
        else {
            echo "insertion error";
        }

    }   
}