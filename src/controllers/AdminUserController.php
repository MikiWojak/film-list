<?php

require_once 'AppController.php';

class AdminUserController extends AppController {

    public function __construct()
    {
        parent::__construct();
    }

    // @TODO Implement
    public function adminUsers() {
        return $this->render('admin-users');
    }

    // @TODO Implement
    public function adminAddUser()
    {
        return $this->render('admin-users-createedit');
    }
}
