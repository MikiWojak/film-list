<?php

require_once 'AppController.php';
require_once  __DIR__.'/../models/User.php';
require_once  __DIR__.'/../repositories/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user =  $this->userRepository->findByEmail($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User not exists']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exists']]);
        }

        if (password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

//        return $this->render('films', [
//            "films" => [],
//            "title" => "Films"
//        ]);

        // @TODO Keep session / cookie

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/films");
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->render('register');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        // @TODO Sanitize data
        // @TODO Check if agreed with terms
        // @TODO Check if username already exists
        // @TODO Check if email already exists

        if ($password !== $confirmedPassword) {
            return $this->render('login', ['messages' => ['Passwords do not match']]);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(
            $username,
            $email,
            $hashedPassword
        );

        $this->userRepository->create($user);

        // @TODO Show Login
        return $this->render('login', ['messages' => ['Registration complete']]);
    }

    public function logout() {
        // @TODO
    }
}
