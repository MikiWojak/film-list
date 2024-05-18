<?php

class Routing {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            $errController = 'DefaultController';
            $errObject = new $errController;
            $errAction = 'notFound';

            return $errObject->$errAction();
        }

        $controller = self::$routes[$action];
        // Object based on String
        $errObject = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        if (preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $id)) {
            $errObject->$action($id);
        } else {
            $errObject->$action();
        }
    }
}
