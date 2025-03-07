<?php
class Admin_Controller_Media_Index extends Core_Controller_Admin_Action {
    public function viewAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('admin/media_view');
        $layout->getChild('content')->addChild('view',$view);
        $layout->toHtml();
    }

    public function deleteAction()
    {
        $fileId = $this->getRequest()->getParam('imageid');
        if(is_array($fileId))
        {
            foreach($fileId as $file)
            {
                $media = Mage::getModel('catalog/media_gallery');
                $media->load($file);
                unlink($media->getFilePath());
                $media->delete();
            }
        }
        else {
            $media = Mage::getModel('catalog/media_gallery');
            $media->load($fileId);
            
            unlink($media->getFilePath());
            $media->delete();
        }
        // echo ($fileId);
        // die();  
        
    }   

    public function updatecoverAction()
    {
        $fileId = $this->getRequest()->getParam('imageid');
        $media = Mage::getModel('catalog/media_gallery');
        $media->load($fileId);

        $mediaCollection = $media->getCollection();
        $mediaCollection->addFieldToFilter('product_id',$media->getProductId())
            ->addFieldToFilter('cover_image',1);
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


}
