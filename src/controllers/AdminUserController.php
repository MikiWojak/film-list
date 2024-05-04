<?php

require_once 'AppController.php';

class AdminUserController extends AppController {

    public function __construct()
    {
        parent::__construct();
    }

    // @TODO Implement
    public function adminusers() {
        return $this->render('admin-users');
    }
}
