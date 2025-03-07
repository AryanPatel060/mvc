<?php 
class Admin_Block_Media_View extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate('admin/media/view.phtml');
    }

    public function getFilesData()
    {
        $request = Mage::getModel('core/request');
        $productId = $request->getQuery('id');

        $media = Mage::getModel('catalog/media_gallery')
            ->getCollection()
            ->addFieldToFilter('product_id',$productId);
        return $media->getData();   
    }
}
?>