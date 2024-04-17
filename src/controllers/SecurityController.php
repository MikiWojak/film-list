<?php

require_once 'AppController.php';
require_once  __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User(
            'johndoe',
            'john.doe@film.test',
            'test'
        );

        $email = $_POST['email'];
        $password = $_POST['password'];

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
}