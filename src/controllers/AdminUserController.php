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
        $users = $this->userRepository->findAll();

        return $this->render('admin-users', [
            'users' => $users
        ]);
    }

    public function admindeleteuser(string $id)
    {
        $this->userRepository->delete($id);

        // @TODO Recalvulate averages!

        $url = "http://$_SERVER[HTTP_HOST]";
        return header("Location: {$url}/adminusers");
    }

}
