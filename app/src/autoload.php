<?php

namespace App;

class Autoloader
{
    static public function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    static public function autoload($class)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        $class = str_replace('\\', '/', $class);

        $file = __DIR__ . '/' . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}