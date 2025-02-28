<?php 
class Admin_Model_user extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Admin_Model_Resource_User";
        $this->_collectionClassName = "Admin_Model_Resource_User_Collection";
    }
}