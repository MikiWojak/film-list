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
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        // Object based on String
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        // @TODO Restore $object->$action($id); if in vain
        if (preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $id)) {
            $object->$action($id);
        } else {
            $object->$action();
        }
    }
}
