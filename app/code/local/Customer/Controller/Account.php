<?php
class Customer_Controller_Account extends Core_Controller_Customer_Action
{
    protected $_allowed = [
        'login',
        // 'loginAction',
        'loginpost',
        'signup',
        'signuppost'
        // 'loginpostAction',c
    ];
    public function loginAction()
    {
        $layout = $this->getLayout();
        $login = $layout->createBlock('customer/account_login');
        $layout->getChild('content')->addChild('customerlogin', $login);
        $layout->toHtml();
    }
    public function signupAction()
    {
        $layout = $this->getLayout();
        $signup = $layout->createBlock('customer/account_signup');
        $layout->getChild('content')->addChild('customersignup', $signup);
        $layout->toHtml();
    }

    public function signuppostAction()
    {
        $customer = $this->getRequest()->getParam('customer');
        $address = $this->getRequest()->getParam('address');

        mage::log($customer);
        $account = Mage::getModel("customer/account");
        $email = $account->load($customer['email'],'email');
        mage::log($email->getData());
        if (!$email->getData()) {
            $new = $account->setData($customer)
                ->save();
            Mage::getModel("customer/account_address")
                ->setData($address)
                ->setCustomerId($new->getCustomerId())
                ->setIsDefault(1)
                ->save();
            
            $this->getSession()->set('customerLogin',1);
            $this->getSession()->set('customerId',$new->getCustomerId());
            $this->redirect("customer/dashboard/index");
        }
        else{
            echo "email already exits";
        }
    }
    public function loginpostAction()
    {
        $loginData = $this->getRequest()->getParam('login');
        $email = $loginData['email'];
        $password = $loginData['password'];
        $user = Mage::getModel('customer/account')
            ->getCollection()
            ->addFieldToFilter('email', $email)
            ->addFieldToFilter('password', $password);
        $result = $user->getFirstItem();
        // Mage::log($result->getData());
        // Mage::log($result->getCustomerId());
        // die();
        if ($result->getData()) {
            $this->getSession()->set('customerLogin', 1);
            $this->getSession()->set('customerId', $result->getCustomerId());

            $this->redirect('customer/dashboard/index');
        } else {
            $this->getSession()->remove('customerLogin');
            $this->redirect('customer/account/login');
        }
    }

    public function logoutAction()
    {
        if ($this->getSession()->get('customerLogin')) {
            $this->getSession()->remove('customerLogin');
            $this->getSession()->remove('customerId');
            $this->redirect('');
        }
    }

}
