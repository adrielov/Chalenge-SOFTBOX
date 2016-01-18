<?php
namespace App;

use App\Router;
use App\vars;

class Application {
    private static $vars = array();

    public function run() {
        Router::init();
        $routerParams = Router::match($_SERVER["REQUEST_URI"]);
        if ($routerParams === false) {
            die("403 Bad Request: Route not found");
        }
        
        $controllerFullName = "\\App\\Controllers\\" . $routerParams["_controller"];
        if (!method_exists($controllerFullName, $routerParams["_method"])) {
            die("404 not found");
        }
        
        $reflectionMethod = new \ReflectionMethod($controllerFullName, $routerParams["_method"]);
        $reflectionMethod->invokeArgs(new $controllerFullName(), $routerParams["_params"]);
    }

    public static function set($name, $value) {
        static::$vars[$name] = $value;
        return true;
    }

    public static function get($name) {
        return (array_key_exists($name, static::$vars) && !empty(static::$vars[$name]))?static::$vars[$name]:NULL;
    }
}