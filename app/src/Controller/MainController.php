<?php

namespace App\Controller;

class MainController extends AbstractController
{
    public function index()
    {
        $this->render('index');
    }
}