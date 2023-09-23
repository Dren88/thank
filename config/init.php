<?php
define("ROOT", dirname(__DIR__));
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'default');
define("APP", ROOT . '/app');
define("PER_PAGE", 20);

spl_autoload_register(function($name){
    $path = str_replace('\\', '/', $name) . '.php';
    if(file_exists($path)){
        include_once($path);
    }
});

require_once ROOT . '/vendor/autoload.php';