<?php

class Theme
{

    public static function notFound()
    {
        return Response::make(static::view('404'), 404);
    }

    public static function exists($view)
    {
        if (is_null($view)) return false;

        $theme = get_option('site_theme', 'default');

        return file_exists(PATH . 'themes' . DS . $theme . DS . $view . EXT);
    }

    public static function view($view, $data = array()) {
        return Template::make($view, $data);
    }

}