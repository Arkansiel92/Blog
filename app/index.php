<?php

use App\Autoloader;
use App\View\Main;

define('ROOT', dirname(__FILE__) . '/src');

require_once ROOT . '/autoload.php';

Autoloader::register();

$app = new Main;

$app->start();