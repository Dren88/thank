<?php


namespace System;


class Router
{

    protected static $routes = [];
    protected static $route = [];

    public static function add($reqexp, $route = [])
    {
        self::$routes[$reqexp] = $route;
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === str_contains($params[0], '=')) {
                return rtrim($params[0], '/');
            }
        }
        return '';
    }

    /**
     * @param $url
     * @throws \Exception
     * Пытаемся найти и подключить класс контроллера
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['controller']. 'Controller';
            if(class_exists($controller)){
                /** @var Controller $controllerObject*/
                $controllerObject = new $controller(self::$route);

                $controllerObject->getModel();

                $action = self::lowerCamelCase(self::$route['action'] . 'Action');
                if (method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->getView();
                }else{
                    throw new \Exception("Метод {$controller}::{$action} не найден", 404);
                }
            }else{
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }
        }else{
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public static function matchRoute($url): bool
    {
        foreach (self::$routes as $pattern => $route) {

            if (preg_match("#{$pattern}#", $url, $matches) || preg_match("#{$pattern}#", $url . '/', $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase($name): string
    {
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    protected static function lowerCamelCase($name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }
}