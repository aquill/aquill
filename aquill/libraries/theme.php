<?php

class Theme
{

    public function __construct($view)
    {
        $filename = $this->path($view) . 'theme.info';
        $info = parse_ini_file($filename);

        $this->view = $view;

        foreach (array('.jpg', '.png') as $extension) {
            if (file_exists($this->path($view) . '/screenshot' . $extension)) {
                $this->screenshot = asset('themes/' . $view . '/screenshot' . $extension);
            }
        }

        foreach ($info as $key => $value) {
            $this->$key = $value;
        }
    }

    public function author()
    {
        if (is_null($this->author_url)) {
            return sprintf('<span>%s</span>', $this->author);
        }
        
        return sprintf('<a href="%s">%s</a>', $this->author_url, $this->author);
    }

    /**
     * Magic Method for handling dynamic data access.
     */
    public function __get($key)
    {
        return $this->$key;
    }

    /**
     * Magic Method for handling the dynamic setting of data.
     */
    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public static function all() {
        $paths = glob(PATH . 'themes/*/');

        foreach ($paths as $path) {
            $themes[] = new static(basename($path));
        }

        return $themes;
    }

    public static function get($theme) {
        return new static($theme);
    }

    public static function notFound()
    {
        return Response::make(static::view('404'), 404);
    }

    public function path($view)
    {
        return PATH . 'themes' . DS . $view . DS;
    }

    public static function __callStatic($method, $paramaters = array()) {
        if ($method == 'path') {
            return static::getPath(array_shift($paramaters));
        }
    }

    public static function view($view, $data = array()) {
        return Template::make($view, $data);
    }

}