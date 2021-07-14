<?php
require_once 'Logger.php';

class Route {
    public const CONTROLLER_PREFIX = "Controller_";
    public const METHOD_PREFIX = "action_";
    
    static function start() {
        $controller_name = 'Main';
        $action_name = 'showWelcomePage';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // derive controller name
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        // obtain action id
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }
        
        Logger::getInstance()->log(__METHOD__ . " " . $_SERVER['REQUEST_URI']);

        // include needed functional
        $controller_name = self::CONTROLLER_PREFIX . $controller_name;
        $action_name = self::METHOD_PREFIX . $action_name;

        $controller_file = $controller_name . '.php';
        $controller_path = "${_SERVER['DOCUMENT_ROOT']}/controller/" . $controller_file;
        
        Logger::getInstance()->log(__METHOD__ . ' controller_path ' . $controller_path);
        
        if (file_exists($controller_path)) {
            include $controller_path;
        } else {
            self::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            self::ErrorPage404();
        }
    }

    static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
