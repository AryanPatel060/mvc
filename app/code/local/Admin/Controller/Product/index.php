<?php
class Admin_Controller_Product_Index
{
    public $data ;
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Product_Index_New');
        $layout->getChild('content')->addChild('new', $new);

        $layout->getChild('head')
        ->removeJs()
        ->addJs('admin/new.js');

        $layout->toHtml();    
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('Admin/Product_Index_List');
            // ->setTemplate('Admin/Product/Index/List.phtml');
        //    print_r($view);
        
        $layout->getChild('content')->addChild('list', $list);
        $layout->getChild('head')->addCss('admin/main.css');

        $layout->toHtml();
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('deleteid');

        $product = Mage::getModel('catalog/product');
        $product->load($id);

        $result = $product->delete();
        if($result)
        {
            $data = $product->getData();
            $imagepath = $data['image'];
            unlink($imagepath);
            $product->removeData();
        }
        header("location:http://localhost/MVC/admin/product_index/list");
      
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $data = $request->getParam('catlog_product');

        echo "<pre>";
        print_r($data);
        print_r($_FILES);

        if (!isset($data['image'])) {
            if (isset($_FILES['catlog_product']['name']['image'])) {
                
                $media = 'media/';
                $imagePaths = []; // Array to store uploaded image paths
                
                foreach ($_FILES['catlog_product']['name']['image'] as $key => $imageName) {
                    if ($_FILES['catlog_product']['error']['image'][$key] === 0) { // No upload errors
                        $tmpName = $_FILES['catlog_product']['tmp_name']['image'][$key];
                        $imageType = $_FILES['catlog_product']['type']['image'][$key];
        
                        // Generate a unique name to avoid conflicts
                        $uniqueName = (($key == 'thumbnail')?'thumbnail_':"" ).uniqid() . '_' . basename($imageName);
                        $targetPath = $media . $uniqueName;
                        
                        // Move uploaded file to the media directory
                        if (move_uploaded_file($tmpName, $targetPath)) {
                            $imagePaths[] = $targetPath; // Store path for database
                        }
                        }
                    }
                    
                    print_r($imagePaths);
                    // die();
        
                // Save image paths as JSON in the database for multiple images
                if (!empty($imagePaths)) {
                    $data['image'] = json_encode($imagePaths);
                }
        
                print_r($data);
            }
        }
        die();


        $product = Mage::getModel('catalog/product');
        $product->setData($data);
        echo "<pre>";
        print_r($data);
        $insertId = $product->save();
        if($insertId){
            if(move_uploaded_file($_FILES['catlog_product']['tmp_name']['image'],$imagepath)){
                echo "Image uploaded succefully!";
            }
            else {
                echo "error in saving file";
            }
        }
        // die();

        header("location:http://localhost/MVC/admin/product_index/list");
    }
    public function abcAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('Admin/Product_Index_New')
                        ->setTemplate('Admin/Product/Index/abc.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('main2.css');
        $layout->toHtml();    
    }
}
