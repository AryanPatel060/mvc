<?php

class Core_Model_Request
{
    protected $_moduleName;
    protected $_controlleName;
    protected $_actionName;
    protected $_baseUrl = "http://localhost/MVC/";
    protected $_baseDirectory = "C:/xampp/htdocs/mvc/";

    public function __construct()
    {
        $uri = $this->getRequestUri();
        $uri = array_filter(explode("/", $uri));
        $this->_moduleName = isset($uri[0]) ? $uri[0] : "cms";
        $this->_controlleName = isset($uri[1]) ? $uri[1] : "index";
        $this->_actionName = isset($uri[2]) ? $uri[2] : "index";
    }
    public function getModuleName()
    {
        return $this->_moduleName;
    }
    public function getControllerName()
    {
        return $this->_controlleName;
    }
    public function getActionName()
    {
        return $this->_actionName;
    }
    public function getparam($field)
    {
        if (isset($_POST[$field])) {
            return $_POST[$field];
        } else {
            return '';
        }
    }
    public function getQuery($field)
    {
        if (isset($_GET[$field])) {
            return $_GET[$field];
        } else {
            return '';
        }
    }
    public function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace("/MVC/", "", $uri);
        return $uri;
    }
}
