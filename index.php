<?php

require_once 'Routing.php';
require_once 'src/controllers/FilmController.php';
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminFilmController.php';
require_once 'src/controllers/AdminUserController.php';

$controller = new AppController();

// Process URL from client --> Process request from client
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('profile', 'DefaultController');

Routing::get('film', 'FilmController');
Routing::get('films', 'FilmController');
Routing::post('search', 'FilmController');

Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('register', 'SecurityController');

Routing::get('adminFilms', 'AdminFilmController');
Routing::post('adminAddFilm', 'AdminFilmController');

Routing::get('adminUsers', 'AdminUserController');

Routing::run($path);
