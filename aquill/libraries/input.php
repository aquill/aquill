<?php

class Input extends Laravel\Input {

    /**
     * Get an item from the input data.
     *
     * This method is used for all request verbs (GET, POST, PUT, and DELETE)
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public static function get($key = null, $default = null, $cleanse = null)
    {
        $value = parent::get($key, $default);

        if ( $cleanse or Config::get('app.xss')) {
            $value = Security::xss_clean($value);
        }

        return $value;
    }

}