<?php

namespace App\View;

use App\Controller\MainController;

class Main
{
    public function start()
    {
        session_start();
        
        $uri = $_SERVER['REQUEST_URI'];

        if (!empty($uri) && $uri != "/" && $uri[-1] == "/") {
            $uri = substr($uri, 0, -1);

            http_response_code(301);
            header('Location: '. $uri);
        }

        $params = explode("/", $_GET['path']);

        if(!empty($params[0])) {
            $controller = '\\App\\Controller\\'. ucfirst(array_shift($params).'Controller');
            $controller = new $controller();

            $action = isset($params[0]) ? array_shift($params) : 'index';

            if(method_exists($controller, $action)) {
                (isset($params[0])) ? $controller->$action($params) : $controller->$action();
            } else {
                http_response_code(404);
                echo "la page n'existe pas";
            }

        } else {
            $controller = new MainController();

            $controller->index();
        }


    }
}