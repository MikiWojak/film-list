<?php

require_once 'Routing.php';
require_once 'src/controllers/FilmController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminFilmController.php';
require_once 'src/controllers/AdminUserController.php';
require_once 'src/controllers/AdminDirectorController.php';

$controller = new AppController();

// Process URL from client --> Process request from client
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'FilmController');
Routing::get('film', 'FilmController');
Routing::post('search', 'FilmController');

Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('profile', 'SecurityController');
Routing::post('register', 'SecurityController');

Routing::get('adminfilms', 'AdminFilmController');
Routing::post('admincreatefilm', 'AdminFilmController');

Routing::get('adminusers', 'AdminUserController');

Routing::get('admindirectors', 'AdminDirectorController');

Routing::run($path);
