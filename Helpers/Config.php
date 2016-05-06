<?php

namespace Helpers;

class Config
{
    private static $config;
    public static function  get($key = '')
    {
        if(self::$config == null){
            require_once(ABSPATH . '/config.php');
            global $config;
            self::$config = $config;
        }
        return ($key !== '' && isset(self::$config[$key])) ? self::$config[$key] : '';
    }
}