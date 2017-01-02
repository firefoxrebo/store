<?php
namespace Lilly\Core;

class Messenger
{
    const STATUS_SUCCESS    = 1;
    const STATUS_WARNING    = 2;
    const STATUS_INFO       = 3;
    const STATUS_ERROR      = 4;

    private static $_instance;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function add($key, $message, $type = self::STATUS_SUCCESS)
    {
        if(!array_key_exists($key, $_SESSION)) {
            $_SESSION[$key] = array($message, $type);
        }
    }

    public function statusOf($key)
    {
        if(array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key][1];
        }
    }

    public function get($key) {
        if(array_key_exists($key, $_SESSION)) {
            $message = $_SESSION[$key][0];
            unset($_SESSION[$key]);
            return $message;
        }
    }
}