<?php

// @TODO Refactor router
require_once "src/controllers/AppController.php";
require_once "src/models/Film.php";
require_once "Database.php"; // @TODO Create Singleton

$controller = new AppController();

// Process URL from client --> Process request from client
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
$action = explode("/", $path)[0];
$action = $action == null ? 'login' : $action;

// @TODO Refactor
switch ($action) {
    case "dashboard":
        $result = [];
        $db = Database::getInstance();

        $stmt = $db->connect()->prepare('
            SELECT * FROM "Films"
        ');
        $stmt->execute();
        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($films as $film) {
            $result[] = new Film(
                $film['title'],
                $film['posterUrl']
            );
        }

        $controller->render($action, [
                "films" => $result,
                "title" => "Films"
        ]);

        break;
    case "login":
        $controller->render($action);

        break;
    default:
        $controller->render($action);
}
