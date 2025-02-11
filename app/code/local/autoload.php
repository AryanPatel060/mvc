<?php
spl_autoload_register(function ($className) {
    $classPath = str_replace("_", "/", $className);
    require $classPath . '.php';
});
