<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
       $this->render('login');
    }


    // @TODO Implement. Is it correct place?
    public function profile() {
        $this->render('profile');
    }
}
