<?php
class Customer_Controller_Dashboard extends Core_Controller_Customer_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout();
        $dashboard = $layout->createBlock('customer/index');
        $session = Mage::getSingleton('core/session');
        $customer = Mage::getModel('customer/account')
            ->load($session->get("customerId"));
        $dashboard->setCustomer($customer);
        if ($this->getRequest()->isAjax()) {
            $layout->removeChild('header');
            $layout->removeChild('footer');
            $layout->removeChild('head');

            $dashboard->removeChild('customerinfo');
            $dashboard->removeChild('customerorders');
        }
        $layout->getChild('content')->addChild('dashboard', $dashboard);
        $layout->toHtml();
    }

    
    public function defaultAddressAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $customerId = $this->getSession()->get('customerId');

        $collection = Mage::getModel("customer/account_address");
        $oldId =  $collection->getCollection()
            ->addFieldToFilter('customer_id',$customerId)
            ->addFieldToFilter('is_default', 1) 
            ->getFirstItem()
            ->getAddressId();

        $collection->load($oldId)
            ->setIsDefault(0)
            ->save();
        $collection->load($id)
            ->setIsDefault(1)
            ->save();


        // // Mage::log($collection);
        $this->redirect("customer/dashboard/index");
    }

    public function updateinfoAction()
    {
        $customerid = $this->getRequest()->getParam("id");
        $field = $this->getRequest()->getParam("fieldname");
        $value = $this->getRequest()->getParam("value");

        $data = [];
        $data[$field] = $value;
        $data['customer_id'] = $customerid;
        $model = mage::getModel('customer/account')
            ->setData($data)
            ->save();

        mage::log($model);
    }

}
