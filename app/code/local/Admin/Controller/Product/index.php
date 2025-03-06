<?php
class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{
    // protected $_allowed = [
    //     'list',
    //     'listAction',
    // ];
    public $data;
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
        if ($result) {
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
        // print_r($_FILES);

        $product = Mage::getModel('catalog/product');
        $product->setData($data);


        // print_r($data);
        $insertId = $product->save();
        
        // die();


        // if ($insertId) {
        //     $productId = $insertId->getProductId();
        //     $Attributes = $request->getParam('catalog_product');

        //     $productAttribute = Mage::getModel("catalog/productAttribute");
        //     $attributeModel = Mage::getModel('catalog/attribute');

        //     foreach ($Attributes as $name => $value) {
        //         $attribute_id = $attributeModel->getCollection()
        //             ->select("attribute_id")
        //             ->addFieldToFilter('name', $name);
        //         $attributeId = $attribute_id->getData()[0]->getAttributeId();
        //         $productAttributeData = [
        //             "attribute_id" => $attributeId,
        //             "product_id" => $productId,
        //             "value" => $value
        //         ];
        //         $productsattribute = $productAttribute->getCollection()
        //             ->addFieldToFilter('product_id', $productId)
        //             ->addFieldToFilter('attribute_id', $attributeId);
        //         $result = $productsattribute->getData();
        //         if (count($result) > 0) {
        //             $result = $result[0];
        //             $valueId = $result->getValueId();
        //         } else {
        //             $valueId = "";
        //         }
        //         $productAttributeData['value_id'] = $valueId;
        //         $productAttribute->setData($productAttributeData);
        //         $attid = $productAttribute->save();
        //     }
        // }


        if (!isset($data['image'])) {
            if (isset($_FILES['catlog_product']['name']['image'])) {

                $media = 'media/';
                $imagePaths = []; // Array to store uploaded image paths

                foreach ($_FILES['catlog_product']['name']['image'] as $key => $imageName) {
                    if ($_FILES['catlog_product']['error']['image'][$key] === 0) { // No upload errors
                        $tmpName = $_FILES['catlog_product']['tmp_name']['image'][$key];
                        $imageType = $_FILES['catlog_product']['type']['image'][$key];

                        // Generate a unique name to avoid conflicts
                        $uniqueName = (($key == 'thumbnail') ? 'thumbnail_' : "") . uniqid() . '_' . basename($imageName);
                        $targetPath = $media . $uniqueName;

                        // Move uploaded file to the media directory
                        if (move_uploaded_file($tmpName, $targetPath)) {
                            $filePaths[] = $targetPath; // Store path for database
                            $mediaModel = Mage::getModel('catalog/media');
                            $dataToInsert = [
                                'product_id' => $insertId->getProductId(),
                                'file_path' => $targetPath,
                                'type' => explode('/', $imageType)[0],
                            ];
                            $mediaModel->setData($dataToInsert);
                            $mediainsertId = $mediaModel->save();
                            if ($mediainsertId->getMediaId()) {
                                header("location:http://localhost/MVC/admin/product_index/new");
                            } else {
                                echo "error in saving files";
                            }
                        }
                    }
                }
            }
        }
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
