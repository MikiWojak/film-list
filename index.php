<?php

// @TODO Refactor router
require_once 'src/controllers/AppController.php';
require_once 'src/models/Film.php';

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
        // @TMP
        $film01 = new Film(
            "Psy",
            "https://i.pinimg.com/474x/d9/03/67/d9036710e387d04fb5c74d37159972a9.jpg",
            "Lorem ipsum"
        );

        var_dump($film01);

        $films = [
            $film01 
        ];

        $controller->render($action, [
                "films" => $films,
                "title" => "Films"
        ]);

        break;
    case "login":
        $controller->render($action);

        break;
    default:
        $controller->render($action);
}
