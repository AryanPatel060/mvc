<?php
class Mage
{
    private static $registry = [];
    public static function init()
    {
        $front = new Core_Controller_Front();
        $front->init();
    }

    public static function getModel($className)
    {
        $className = str_replace("/", "_Model_", $className);
        $className = ucwords($className, "_");
        return new $className();
    }
    public static function getBlock($className)
    {
        $className = str_replace("/", "_Block_", $className);
        $className = ucwords($className, "_");
        if (isset(self::$registry[$className])) {
            return self::$registry[$className];

        } else { 
            return self::$registry[$className] = new $className;
        }
         
    }
    public static function getBlockSinglton($className)
    {
        $className = str_replace("/", "_Block_", $className);
        $className = ucwords($className, "_");
        if (isset(self::$registry[$className])) {
            return self::$registry[$className];
        } else {
            return self::$registry[$className] = new $className;
        }
        
    }
    public static function getSingleton($className)
    {
        $className = str_replace("/", "_Model_", $className);
        $className = ucwords($className, "_");
        if (isset(self::$registry[$className])) {
            return self::$registry[$className];
        } else {
            return self::$registry[$className] = new $className;
        }
    }
    public static function getBaseDir()
    {
        return "C:/xampp/htdocs/MVC/";
    }
    public static function getBaseUrl()
    {
        return "http://localhost/MVC/";
    }

    public static function log($data)
    {
        echo"<pre>";
        print_r($data);
        echo"</pre>";
    }
}
