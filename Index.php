<?php
include_once("./app/Mage.php");
include_once("./app/code/local/autoload.php");

error_reporting(E_ALL);
define("DS", DIRECTORY_SEPARATOR);
date_default_timezone_set('Asia/Kolkata');

Mage::getSingleton('core/session');
Mage::init();


// front action -getrequest() getredirect() getsession()

// core/controller/adminaction - init methosd for login access and rediection 

// core / session.php - get() set() getId() remove() --construct sessionstart()

// loginactionand loginpostaction admin model for data 
