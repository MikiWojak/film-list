<?php

require_once 'AppController.php';

class AdminUserController extends AppController {

    public function __construct()
    {
        parent::__construct();
    }

    // @TODO Implement
    public function adminUsers() {
        session_start();

        return $this->render('admin-users');
    }
}
