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

    public function login() {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user =  $this->userRepository->findByEmail($email, true);

        if(!$user) {
            return $this->loginFailedMismathcingCredentials();
        }

        if ($user->getEmail() !== $email) {
            return $this->loginFailedMismathcingCredentials();
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->loginFailedMismathcingCredentials();
        }



        $loggedUser = $this->userRepository->findByEmail($email);

        $_SESSION['loggedUser'] = serialize($loggedUser);

        if ($loggedUser->isAdmin()) {
            $_SESSION['isAdmin'] = serialize($loggedUser->isAdmin());
        }

        if ($loggedUser->isUser()) {
            $_SESSION['isUser'] = serialize($loggedUser->isUser());
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        return header("Location: {$url}/profile");
    }

    public function logout() {
        session_unset();
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        return header("Location: {$url}/films");
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

        $roles = [];
        $roles[] = $this->roleRepository->findByName(Role::ROLE_USER); // @TODO What is not found?

        $user = new User(
            $username,
            $email,
            $roles,
            $hashedPassword
        );

        $this->userRepository->create($user);

        return $this->render('login', ['messages' => ['Registration complete']]);
    }

    private function loginFailedMismathcingCredentials() {
        $this->render('login', ['messages' => ['Mismatching credentials']]);
    }
}
