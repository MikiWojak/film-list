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

    public function admindeleteuser(string $id)
    {
        $loggedUser = unserialize($_SESSION['loggedUser']);
        $loggedUserId = $loggedUser->getId();

        if ($loggedUserId === $id) {
            return $this->render(
                'admin-users',
                ['messages' => ["You can't delete your own account!"]]
            );
        }

        $this->userRepository->delete($id);

        $this->filmRepository->refreshAllAvgRate();

        $url = "http://$_SERVER[HTTP_HOST]";
        return header("Location: {$url}/adminusers");
    }

}
