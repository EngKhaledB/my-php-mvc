<?php

namespace Base;

use Controllers;

class App
{
    public function run(Router $router)
    {
        $controller = $router->getController();
        $method = $router->getMethod();
        $controller = '\\Controllers\\'.ucfirst($controller);
        $instance = new $controller();
        if(method_exists($instance,$method)) {
            call_user_func_array(array($instance, $method), array("three", "four"));
        }else{
            die("<h1>Unable to find method $method</h1>");
        }
    }
}