<?php

require_once 'AppController.php';
require_once  __DIR__.'/../repositories/UserRepository.php';

class AdminUserController extends AppController {
    private $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = new UserRepository();
    }

    public function adminusers() {
        // @TODO Get Users with Roles
        $users = $this->userRepository->findAll();

        return $this->render('admin-users', [
            'users' => $users
        ]);
    }
}
