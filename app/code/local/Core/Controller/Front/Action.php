<?php
class Core_Controller_Front_Action extends Core_Controller_Front
{
    // getrequest() getredirect() getsession()

    

    public function getRequest()
    {
        return Mage::getSingleton('core/request');
    }
    public function getSession()
    {
        return Mage::getSingleton('core/session');
    }
    public function redirect($url)
    {
        $_url = MAge::getBaseUrl() . $url;
        header('location:' . $_url);
        return $this;
    }
    public function getLayout()
    {
        return Mage::getBlock("core/layout");
    }
}
