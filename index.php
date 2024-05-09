<?php

require_once 'Routing.php';
require_once 'src/models/Role.php';
require_once 'src/controllers/FilmController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminFilmController.php';
require_once 'src/controllers/AdminUserController.php';
require_once 'src/controllers/AdminDirectorController.php';

$controller = new AppController();

// Process URL from client --> Process request from client
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

function isLoggedIn() {
    return isset($_SESSION['loggedUser']);
}

function hasRole($role) {
    if (!isLoggedIn()) return false;

    $loggedUser = unserialize($_SESSION['loggedUser']);

    return $loggedUser->hasRole($role);
}

Routing::get('', 'FilmController');
Routing::get('film', 'FilmController');
Routing::post('search', 'FilmController');

if (isLoggedIn()) {
    Routing::post('logout', 'SecurityController');
    Routing::get('profile', 'SecurityController');

    if (hasRole(ROLE::ROLE_USER)) {
        Routing::get('rate', 'FilmController');
        Routing::get('removerate', 'FilmController');
    }

    if (hasRole(ROLE::ROLE_ADMIN)) {
        Routing::get('adminfilms', 'AdminFilmController');
        Routing::post('admincreatefilm', 'AdminFilmController');
        Routing::get('adminusers', 'AdminUserController');
        Routing::get('admindirectors', 'AdminDirectorController');
    }
} else {
    Routing::post('login', 'SecurityController');
    Routing::post('register', 'SecurityController');
}

Routing::run($path);
