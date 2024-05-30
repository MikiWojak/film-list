<?php

class Routing {
    private static $routes;

    public static function get(string $url, string $controller): void {
        self::$routes[$url] = $controller;
    }

    public static function post(string $url, string $controller): void {
        self::$routes[$url] = $controller;
    }

    public static function run(string $url): void {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            $action = 'notfound';
        }

        $controller = self::$routes[$action];
        // Object based on String
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        if (preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $id)) {
            $object->$action($id);
        } else {
            $object->$action();
        }
    }
}
