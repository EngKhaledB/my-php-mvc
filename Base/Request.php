<?php

namespace Base;


class Request
{

    public static function get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : '';
    }

    public static function post($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : '';
    }

    public static function request($key)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : '';
    }

    public static function file($key)
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : '';
    }

    public static function server($key)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : '';
    }

} 