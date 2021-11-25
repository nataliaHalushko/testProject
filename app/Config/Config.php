<?php

namespace App\Config;

class Config
{
    private static $config;

    public static function get(string $key, $default = null)
    {
        if (is_null(self::$config)) {
            self::$config = require_once(__DIR__ . '/../../config.php');
        }
        return  self::$config[$key];
    }
}
