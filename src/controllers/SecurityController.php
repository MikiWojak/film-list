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

    public function login(): void {
        if(!$this->isPost()) {
            $this->render('login');

            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->render('login',
                ['messages' => ['Credentials cannot be empty.']]
            );

            return;
        }

        $user =  $this->userRepository->findByEmail($email, true);

        if(!$user) {
            $this->loginFailedMismathcingCredentials();

            return;
        }

        if (!password_verify($password, $user->getPassword())) {
            $this->loginFailedMismathcingCredentials();

            return;
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
        header("Location: {$url}/profile");
    }

    public function logout(): void {
        session_unset();
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }

    public function profile(): void {
        if (!isset($_SESSION['loggedUser'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");

            return;
        }

        $loggedUser = unserialize($_SESSION['loggedUser']);

        $this->render('profile', [
            "username" => $loggedUser->getUsername(),
        ]);
    }

    public function register(): void {
        if(!$this->isPost()) {
            $this->render('register');

            return;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        if (empty($username) || empty($email) || empty($password) || empty($confirmedPassword)) {
            $this->render('register',
                ['messages' => ['Fill in all fields.']]
            );

            return;
        }

        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) || $email !== $sanitizedEmail) {
            $this->render('register',
                ['messages' => ['Enter valid email.']]
            );

            return;
        }

        $userWithExistingUsername = $this->userRepository->findByUsername($username);

        if ($userWithExistingUsername !== null) {
            $this->render('register', ['messages' => ['User with given username already exists.']]);

            return;
        }

        $userWithExistingEmail = $this->userRepository->findByEmail($email);

        if ($userWithExistingEmail !== null) {
            $this->render('register', ['messages' => ['User with given email already exists.']]);

            return;
        }

        if ($password !== $confirmedPassword) {
            $this->render('register', ['messages' => ['Passwords do not match.']]);

            return;
        }

        if (!isset($_POST['terms'])) {
            $this->render('register', ['messages' => ['Agree terms and conditions.']]);

            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $role = $this->roleRepository->findByName(Role::ROLE_USER);

        $user = new User(
            $username,
            $email,
            $role,
            $hashedPassword
        );

        $this->userRepository->create($user);

        $this->render('login', ['messages' => ['Registration complete.']]);
    }

    private function loginFailedMismathcingCredentials(): void {
        $this->render('login', ['messages' => ['Mismatching credentials.']]);
    }
}
