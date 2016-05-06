<?php

namespace Base;

/**
 * Class Controller
 * @package Base
 * @property Router $router
 */
class Controller
{
    public $router;

    function __construct()
    {
        global $router;
        $this->router = $router;
    }

}