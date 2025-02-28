<?php 
class Core_Controller_Admin_Action extends Core_Controller_Front_Action
{
    protected $_allowed = [];
    public function __construct()
    {   
        $this->init();
    }

    public function init()
    {
        if(!in_array($this->getRequest()->getActionName(),$this->_allowed))
        {
            $islogin = $this->getSession()->get('login');
            if($islogin === 1)
            {

            }
            else {
                $this->redirect('');//redirect to home cms
            }
        }
    }
}
