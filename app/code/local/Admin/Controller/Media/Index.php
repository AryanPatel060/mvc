<?php
class Admin_Controller_Media_Index extends Core_Controller_Admin_Action
{
    public function viewAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('admin/media_view');
        $layout->getChild('content')->addChild('view', $view);
        // 
        $layout->getChild('head')->addJs('admin/new.js');
        $layout->toHtml();
    }

    public function deleteAction()
    {
        $fileId = $this->getRequest()->getParam('imageid');
        // echo ($fileId);
        // die();

        if (is_array($fileId)) {
            foreach ($fileId as $file) {
                $media = Mage::getModel('catalog/media_gallery');
                $media->load($file);
                unlink($media->getFilePath());
                $media->delete();
            }
        } else {
            $media = Mage::getModel('catalog/media_gallery');
            $media->load($fileId);

            unlink($media->getFilePath());
            $media->delete();
        }
        // die();  

    }

    public function updatecoverAction()
    {
        $fileId = $this->getRequest()->getParam('imageid');
        $media = Mage::getModel('catalog/media_gallery');
        $media->load($fileId);

        $mediaCollection = $media->getCollection();
        $mediaCollection->addFieldToFilter('product_id', $media->getProductId())
            ->addFieldToFilter('cover_image', 1);
        print_r($media->getProductId());
        // die();
        $oldcoverId = $mediaCollection->getData()[0]->getMediaId();
        $media->load($oldcoverId);
        $oldcoverData = $media->getData();
        $oldcoverData['cover_image'] = 0;
        $media->setData($oldcoverData);
        $media->save();

        $media->load($fileId);
        $newdata = $media->getData();
        $newdata['cover_image'] = 1;
        $media->setData($newdata);
        $media->save();
        // print_r($oldcoverId,$fileId);    
    }

    public function uploadAction()
    {
        $productId = $this->getRequest()->getParam('productId');
        if (isset($_FILES['images']['name'])) {
            $media = 'media/';
            $imagePaths = []; // Array to store uploaded image paths
            foreach ($_FILES['images']['name'] as $key => $imageName) {
                if ($_FILES['images']['error'][$key] === 0) { // No upload errors
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $imageType = $_FILES['images']['type'][$key];

                    // Generate a unique name to avoid conflicts
                    $uniqueName =  uniqid() . '_' . basename($imageName);
                    $coverImage = (($key == 'thumbnail') ? 1 : 0);
                    $targetPath = $media . $uniqueName;

                    // Move uploaded file to the media directory

                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $filePaths[] = $targetPath; // Store path for database
                        $mediaModel = Mage::getModel('catalog/media_gallery');

                        $dataToInsert = [
                            'product_id' => $productId,
                            'file_path' => $targetPath,
                            'type' => explode('/', $imageType)[0],
                            'cover_image' => $coverImage
                        ];
                        $mediaModel->setData($dataToInsert);
                        $mediainsertId = $mediaModel->save();
                    }
                    print_r($dataToInsert);
                }
            }
        }
    }
}
