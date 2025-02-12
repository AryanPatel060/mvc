<?php
class Core_Model_Abstract{
    protected $_resourceClassName;

    public function __construct()
    {
        // $this->init();
    }
    public function getResourceModel()
    {
        return new $this->_resourceClassName();
    }
}