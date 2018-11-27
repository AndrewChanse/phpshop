<?php

class Router 
{
    public $routes;
    
    public function __construct() {
        $routPath = ROOT.'/config/routes.php';
        $this->routes = include_once $routPath;
    }
    
    private function getURI() {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function Run() {
        $uri = $this->getURI();
        
        foreach($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~", $uri)) {
                $innerPath = preg_replace("~$uriPattern~", $path, $uri);
                //echo '<pre>';                print_r($innerPath); die();
                $segments = explode('/', $innerPath);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));
                $params = $segments;
                
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if(file_exists($controllerFile)) {
                    include_once $controllerFile;
                }
                $controllerObj = new $controllerName;
                $result = call_user_func_array([$controllerObj, $actionName], $params);
                if($result != null) {
                    break;
                }
            }
        }
    }
}
