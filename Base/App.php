<?php

namespace Base;

use Controllers;

class App
{
    public function run(Router $router)
    {
        $controller = $router->getController();
        $method = $router->getMethod();
        $controller = '\\Controllers\\' . ucfirst($controller);
        $instance = new $controller();

        if(get_parent_class($instance) !== 'Base\RestController' ) {
            if(method_exists($instance,$method)) {
                call_user_func(array($instance, $method));
            }else{
                die("<h1>Unable to find method $method</h1>");
            }
        }
    }
}