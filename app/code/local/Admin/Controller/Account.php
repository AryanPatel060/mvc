<?php
class Admin_Controller_Account extends Core_Controller_Admin_Action
{
    protected $_allowed = [
        'login',
        // 'loginAction',
        'loginpost',
        // 'loginpostAction',c
    ];
    public function loginAction()
    {
        $layout = Mage::getBlock('core/layout');
        $login = $layout->createBlock('admin/account_login');
        $layout->getChild('content')->addChild('login', $login);
        $layout->toHtml();
    }

    public function loginpostAction()
    {
        $loginData = $this->getRequest()->getParam('login');
        $username = $loginData['username'];
        $password = $loginData['password'];
        $user = Mage::getModel('admin/User')
            ->getCollection()
            ->addFieldToFilter('username', $username)
            ->addFieldToFilter('password_hash', $password);
        $result = $user->getData();
        if ($result) {
            $this->getSession()->set('login', 1);

            // print_r($this->getSession()->get('login'));
            // die();
            $this->redirect('admin/product_index/list');
        } else {
            $this->getSession()->remove('login');
            $this->redirect('admin/account/login');
        }
    }

    public function logoutAction()
    {
        if ($this->getSession()->get('login')) {
            $this->getSession()->remove('login');
            $this->redirect('admin/account/login');
        }
    }
}
