<?php
class Catalog_Model_Product extends Core_Model_Abstract
{
    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];
    public function init()
    {
        $this->_resourceClassName  = "Catalog_Model_Resource_Product";
        $this->_collectionClassName  = "Catalog_Model_Resource_Product_Collection";
    }
    public function getStatusText()
    {
        if (isset($this->status[$this->getStatus()])) {
            return $this->status[$this->getStatus()];
        } else {
            return "NA";
        }
    }
    protected function _afterSave()
    {
        if (isset($_FILES['catlog_product']['name']['image'])) {
            $media = 'media/';
            $imagePaths = []; // Array to store uploaded image paths
            foreach ($_FILES['catlog_product']['name']['image'] as $key => $imageName) {
                if ($_FILES['catlog_product']['error']['image'][$key] === 0) { // No upload errors
                    $tmpName = $_FILES['catlog_product']['tmp_name']['image'][$key];
                    $imageType = $_FILES['catlog_product']['type']['image'][$key];

                    // Generate a unique name to avoid conflicts
                    $uniqueName =  uniqid() . '_' . basename($imageName);
                    $coverImage = (($key == 'thumbnail') ? 1 : 0);
                    $targetPath = $media . $uniqueName;

                    // Move uploaded file to the media directory
                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $filePaths[] = $targetPath; // Store path for database
                        $mediaModel = Mage::getModel('catalog/media_gallery');

                        $dataToInsert = [
                            'product_id' => $this->getProductId(),
                            'file_path' => $targetPath,
                            'type' => explode('/', $imageType)[0],
                            'cover_image' => $coverImage
                        ];
                        $mediaModel->setData($dataToInsert);
                        $mediainsertId = $mediaModel->save();
                    }
                }
            }
        }

        $attributes = Mage::getModel('catalog/attribute')
            ->getCollection();

        foreach ($attributes->getData() as $_attribute) {
            $productAttributes = Mage::getModel('catalog/product_Attribute')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->addFieldToFilter('attribute_id', $_attribute->getAttributeId())
                ->getData();
            $value = $this->{$_attribute->getAttributeCode()};

            // print_r($productAttributes);
            // die();
            if (isset($productAttributes[0])) {
                $productAttributes[0]->setValue($value)
                    ->save();
            } else {
                Mage::getModel('catalog/product_Attribute')
                    ->setAttributeId($_attribute->getAttributeId())
                    ->setProductId($this->getProductId())
                    ->setValue($value)
                    ->save();
            }
            // print_r($productAttributes);
        }
    }
    protected function _afterload()
    {
        if ($this->getProductId()) {
            $data = Mage::getModel('catalog/product_Attribute')
                ->getCollection()
                ->addFieldToFilter('main_table.product_id', $this->getProductId())
                ->leftJoin(["attr" => "catalog_attribute"], "attr.attribute_id = main_table.attribute_id", ["attribute_code" => "attribute_code"]);
            foreach ($data->getData() as $_data) {
                $this->{$_data->getAttributeCode()} = $_data->getValue();
            }

            $media = Mage::getModel('catalog/media_gallery')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId());

            $images = $media->getData();
            foreach ($images as $image) {
                $filePath = $image->getFilePath();
                if ($image->getCoverImage()) {
                    $this->_data['images']['coverImage'] = $filePath;
                } else {
                    $this->_data['images'][] = $filePath;
                }
            }
        }
        return $this;
    }
}
