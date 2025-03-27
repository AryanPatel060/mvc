<?php class Core_Controller_Customer_Action extends Core_Controller_Front_Action
{

    protected $_allowed = [];
    public function __construct()
    {
        $this->init();
    }
    // get layout

    public function init()
    {
        if (!in_array($this->getRequest()->getActionName(), $this->_allowed)) {
            $islogin = $this->getSession()->get('customerLogin');
            if ($islogin === 1) {
                // $this->redir/ect('admin/product_index/list');
            } else {
                // die();
                $this->redirect('customer/account/login'); //redirect to home cms
            }
        }
    }
}
