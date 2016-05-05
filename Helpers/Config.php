<?php

namespace Helpers;

require_once(ABSPATH . '/config.php');

class Config
{
    public static function  get($key = '')
    {
        global $config;
        return ($key !== '' && isset($config[$key])) ? $config[$key] : '';
    }
}