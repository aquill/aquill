<?php

class Registry {

    private static $data = array();

    public static function get($key, $default = null) {
        if(isset(static::$data[$key])) {
            return static::$data[$key];
        }

        return $default;
    }

    public static function prop($object, $key, $params = array()) {
        if (func_num_args() > 2) {
            $params = func_get_args();
            $object = array_shift($params);
            $key = array_shift($params);
        }

        if($object = static::get($object)) {
            if (method_exists($object, $key)) {
                return call_user_func_array(array($object, $key), $params);
            }
            return $object->{$key};
        }

        return $default;
    }

    public static function set($key, $value) {
        static::$data[$key] = $value;
    }

    public static function has($key) {
        return isset(static::$data[$key]);
    }

}