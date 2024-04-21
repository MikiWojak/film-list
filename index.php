<?php

require_once 'Routing.php';
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminFilmsController.php';

$controller = new AppController();

// Process URL from client --> Process request from client
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('addFilm', 'AdminFilmsController');
Routing::get('films', 'AdminFilmsController');

Routing::run($path);
