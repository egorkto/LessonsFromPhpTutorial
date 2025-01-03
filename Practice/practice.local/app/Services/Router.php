<?php

namespace App\Services;

class Router
{
    private static $list = [];

    public static function page($uri, $page_name)
    {
        self::$list[] = [
            'uri' => $uri,
            'page' => $page_name,
        ];
    }

    public static function post($uri, $controller, $method, $formdata = false, $files = false)
    {
        self::$list[] = [
            'uri' => $uri,
            'class' => $controller,
            'method' => $method,
            'post' => true,
            'formdata' => $formdata,
            'files' => $files,
        ];
    }

    public static function enable()
    {
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        foreach (self::$list as $route) {
            if ($route['uri'] === '/'.$query) {
                if (isset($route['post']) && $route['post'] === true && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $action = new $route['class'];
                    $method = $route['method'];
                    if ($route['formdata'] && $route['files']) {
                        $action->$method($_POST, $_FILES);
                    } elseif ($route['formdata'] && ! $route['files']) {
                        $action->$method($_POST);
                    } else {
                        $action->$method();
                    }
                    exit();
                } else {
                    require_once 'views/pages/'.$route['page'].'.php';
                    exit();
                }
            }
        }
        self::error('404');
    }

    public static function error($error)
    {
        require_once 'views/errors/'.$error.'.php';
    }

    public static function redirect($uri)
    {
        header('Location: '.$uri);
    }
}
