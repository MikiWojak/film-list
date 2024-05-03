<?php
require_once 'AppController.php';
require_once  __DIR__.'/../models/User.php';
require_once  __DIR__.'/../models/Role.php';
require_once  __DIR__.'/../repositories/RoleRepository.php';
require_once  __DIR__.'/../repositories/UserRepository.php';

class SecurityController extends AppController
{
    private $roleRepository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->roleRepository = new RoleRepository();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user =  $this->userRepository->findByEmail($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User not exists']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exists']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

//        return $this->render('films', [
//            "films" => [],
//            "title" => "Films"
//        ]);

        $_SESSION['userId'] = $user->getId();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");
    }

    public function logout() {
        session_start();

        session_unset();

        return $this->render('films');
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->render('register');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        // @TODO Validate data
        // @TODO Sanitize data

        $userWithExistingUsername = $this->userRepository->findByUsername($username);

        if ($userWithExistingUsername !== null) {
            return $this->render('register', ['messages' => ['User with given username already exists']]);
        }

        $userWithExistingEmail = $this->userRepository->findByEmail($email);

        if ($userWithExistingEmail !== null) {
            return $this->render('register', ['messages' => ['User with given email already exists']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Passwords do not match']]);
        }

        if (!isset($_POST['terms'])) {
            return $this->render('register', ['messages' => ['Agree terms and conditions']]);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $role = $this->roleRepository->findByName(Role::ROLE_USER);

        $user = new User(
            $username,
            $email,
            $hashedPassword
        );

        $this->userRepository->create($user, $role);

        return $this->render('login', ['messages' => ['Registration complete']]);
    }
}
