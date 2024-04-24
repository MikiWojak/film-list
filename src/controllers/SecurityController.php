<?php

require_once 'AppController.php';
require_once  __DIR__.'/../models/User.php';
require_once  __DIR__.'/../repositories/UserRepository.php';

class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user =  $userRepository->findByEmail($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User not exists']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exists']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

//        return $this->render('dashboard', [
//            "films" => [],
//            "title" => "Films"
//        ]);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }

    public function register() {
        return $this->render('register', ['messages' => []]);
    }
}
