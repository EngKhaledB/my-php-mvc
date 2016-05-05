<?php

namespace Base;

use Helpers\Config;

class Router
{
    private $controller;
    private $method;
    private $path;
    private $segments;

    public function __construct()
    {
        if (isset($_REQUEST['route']) && !empty($_REQUEST['route'])) {
            $this->path = trim(parse_url($_REQUEST['route'], PHP_URL_PATH), '/');
        } else if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/') {
            $this->path = trim(parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH), '/');
        } else {
            $default = Config::get('default_route');
            if (isset($default) && $default !== '') {
                $this->path = $default;
            } else {
                $ex = new \Exception("No default route on config.php");
                echo $ex->getMessage();
            }
        }


        $this->segments = explode('/', $this->path);

        $this->controller = $this->getController();
        $this->method = $this->getMethod();
    }

    function getPath()
    {
        return $this->path;
    }

    function getSegment($segmentNo = -1)
    {
        $segmentNo = intval($segmentNo);
        if ($segmentNo >= 0 && count($this->segments) > $segmentNo) {
            return $this->segments[$segmentNo];
        }

        return '';
    }

    function getController()
    {
        return $this->getSegment(0);
    }

    function getMethod()
    {
        return $this->getSegment(1);
    }

}