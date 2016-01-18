<?php
namespace App;

class Router {
    
    protected static $routeCollection = [];
    
    public static function add($route, $resource, array $params = []) {
        $route .= substr($route, -1, 1) == "/" ? "" : "/" ;
        static::$routeCollection[$route] = [
            'route'=>$route,
            'resource'=>$resource,
            'params'=>$params
        ];
    }
    
    public static function remove($route) {
        $route .= substr($route, -1, 1) == "/" ? "" : "/" ;
        unset(static::$routeCollection[$route]);
    }

    public static function checkRoute($route) {
        $route  = str_replace(".","/",$route);
        $uri    = substr($_SERVER['REQUEST_URI'],1);
        return ($uri == $route || current(str_word_count($route,2)) == current(str_word_count($uri,2)))? true  : false;
    }

    public static function match($url) {
        $url .= substr($url, -1, 1) == "/" ? "" : "/" ;
        $regex = "/{(.*?)}/";
        $params = [];
        foreach (static::$routeCollection as $route => $data) {
            $params = [];
            
            if (preg_match_all($regex, $route, $matches) > 0) {
                $params = $matches[1];
                $newRoute = preg_replace($regex, "(?P<$1>[a-zA-Z0-9_\-]+)", $route);
                static::$routeCollection[$route]['route'] = $newRoute;
            }
            $regexRoute = "~^".static::$routeCollection[$route]['route']."$~";
            if (preg_match_all($regexRoute, $url,$matches) > 0) {
                list($controller, $method) = explode('@', static::$routeCollection[$route]['resource']);
                $response = [
                    '_controller' => $controller,
                    '_method' => $method,
                    '_params' => []
                ];
                foreach ($matches as $key => $value) {
                    if (!is_numeric($key)) {
                        $response['_params'][$key] = $value[0];
                    }
                }
                return $response;
            }
        }
        return false;
    }
    
    public static function init() {
        require_once ROOT_DIR . 'routes.php';
    }
}