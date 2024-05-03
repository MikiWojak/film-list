<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        session_start();

       $this->render('login');
    }


    // @TODO Implement. Is it correct place?
    public function profile() {
        session_start();

        $this->render('profile');
    }
}
