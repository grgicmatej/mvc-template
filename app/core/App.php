<?php

declare(strict_types=1);

final class App
{
    public static function start(): void
    {
        $pathInfo = Request::pathInfo();
        $pathInfo = trim($pathInfo, '/');
        $pathParts = explode('/', $pathInfo);
        //resolve controller
        if (! isset($pathParts[0]) OR empty($pathParts[0])) {
            $controller = 'Index';
        } else {
            $controller = ucfirst(strtolower($pathParts[0]));
        }
        $controller .= 'Controller';
        //resolve action
        if (! isset($pathParts[1]) OR empty($pathParts[1])) {
            $action = 'index';
        } else {
            $action = strtolower($pathParts[1]);
        }
        //resolve action
        if(! isset($pathParts[2]) OR empty($pathParts[2])) {
            $id = '0';
        } else {
            $id = strtolower($pathParts[2]);
        }
        //dispatch
        if (class_exists($controller) && method_exists($controller, $action)) {
            $controllerInstance = new $controller();
            if (0 !== intval($id)) {
                $controllerInstance -> $action($id);
            } else {
                $controllerInstance -> $action();
            }
        } else {
            header('404');
        }
    }

    public static function config($key)
    {
        $config = include BP . 'app/config.php';
        return $config[$key];
    }
}