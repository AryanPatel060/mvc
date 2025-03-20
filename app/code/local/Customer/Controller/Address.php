<?php class Customer_Controller_Address extends Core_Controller_Front_Action
{
    public function newAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock("customer/address_new");
        $layout->getChild('content')->addChild('new',$new);
        $layout->toHtml();
    }


    public function addAction()
    {
        $address = $this->getRequest()->getParam('address');

        $collection = Mage::getModel("customer/account_address")
            ->setData($address)
            ->save();
        // Mage::log($collection);
        // die();
        $this->redirect("customer/dashboard/index");
    }
    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $data = Mage::getModel("customer/account_address")
            ->load($id)
            ->delete();

        // // Mage::log($collection);
        $this->redirect("customer/dashboard/index");
    }

  
} ?>