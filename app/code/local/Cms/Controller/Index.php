<?php
class Cms_Controller_Index extends Core_Controller_Front_Action{

    public function __construct()
    {
        
        // print_r($class);
    }
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $layout->toHtml();
        // echo __CLASS__ ." ".__FUNCTION__;
    }
}