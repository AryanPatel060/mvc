<?php 
class Core_Controller_Front_Action{
    // getrequest() getredirect() getsession()
    public function getRequest(){
        return Mage::getSingleton('core/request');
    }
    public function getSession()
    {
        return Mage::getSingleton('core/session');
    }
    public function redirect($url)
    {
        $_url = MAge::getBaseUrl().$url;
        header('location:'.$_url);
        return $this;
    }
}