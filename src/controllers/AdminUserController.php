<?php

require_once 'AppController.php';
require_once  __DIR__.'/../repositories/UserRepository.php';
require_once  __DIR__.'/../repositories/FilmRepository.php';

class AdminUserController extends AppController {
    private $userRepository;
    private $filmRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = new UserRepository();
        $this->filmRepository = new FilmRepository();
    }

    public function adminusers() {
        $users = $this->userRepository->findAll();

        return $this->render('admin-users', [
            'users' => $users
        ]);
    }

    public function admindeleteuser()
    {
        $id = $_GET['id'];

        $loggedUser = unserialize($_SESSION['loggedUser']);
        $loggedUserId = $loggedUser->getId();

        if ($loggedUserId === $id) {
            return $this->render('admin-users', [
                'users' => $this->userRepository->findAll(),
                'messages' => ["You can't delete your own account!"]
            ]);
        }

        $this->userRepository->delete($id);

        $this->filmRepository->refreshAllAvgRate();

        $this->render('admin-users', [
            'users' => $this->userRepository->findAll(),
            'messages' => ["User has been deleted."]
        ]);
    }

}
