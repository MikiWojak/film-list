<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound() {
        $this->render('404');
    }
}