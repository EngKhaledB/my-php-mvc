<?php

namespace Base;


class Request
{

    private static $putBody;

    public static function get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : '';
    }

    public static function post($key)
    {
        $inputContent = file_get_contents('php://input');
        $input = json_decode($inputContent);
        return isset($input->$key) ? $input->$key : '';
    }

    public static function put($key)
    {
        if (!isset(self::$putBody)) {
            $inputContent = file_get_contents('php://input');
            self::$putBody = json_decode($inputContent);
        }
        return self::$putBody->$key;
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