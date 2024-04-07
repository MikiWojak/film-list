<?php

// @TODO Refactor router
require_once 'src/controllers/AppController.php';

$controller = new AppController();

// Process URL from client --> Process request from client
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
$action = explode("/", $path)[0];
$action = $action == null ? 'login' : $action;

// @TODO Refactor
// Objects?
switch($action) {
    case "dashboard":
        $films = [
            'The Wind Rises',
            '500',
            'Psy'
        ];

        $controller->render($action, [
                "items" => $films,
                "title" => "Films"
        ]);

        break;
    case "login":
        $controller->render($action);

        break;
    default:
        $controller->render($action);
}
