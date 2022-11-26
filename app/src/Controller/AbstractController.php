<?php

namespace App\Controller;

abstract class AbstractController
{
    public function load(string $entity) {
        $entity = 'App\\Entity\\' . $entity;
        $this->entity = new $entity();
    }

    public function render(string $file, array $data = []) {
        extract($data);
        $className = str_replace('App\Controller\\', '', get_class($this));
        $className = str_replace('Controller', '', $className);
        ob_start();
        require_once(ROOT . '/View/' . strtolower($className) . '/' . $file . '.php');
        $content = ob_get_clean();

        require_once(ROOT . '/View/layouts/default.php');

    }
}