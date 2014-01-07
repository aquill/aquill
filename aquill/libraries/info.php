<?php

class Info
{

    public function __construct($view)
    {
        $view = explode('::', $view);
        $dir = array_shift($view);
        $view = array_shift($view);
        $filename = static::path($dir . 's/' . $view) . $dir . '.info';
        $info = parse_ini_file($filename);

        $this->view = $view;

        if ($dir == 'theme') {
            foreach (array('.jpg', '.png') as $extension) {
                if (file_exists($this->path($dir . 's/' . $view) . '/screenshot' . $extension)) {
                    $this->screenshot = asset('themes/' . $view . '/screenshot' . $extension);
                }
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

    public function __get($key)
    {
        return $this->$key;
    }

    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public static function themes()
    {
        $paths = glob(PATH . 'themes/*/');

        foreach ($paths as $path) {
            $themes[] = new static('theme::'.basename($path));
        }

        return $themes;
    }   

    public static function bundles()
    {
        $paths = glob(PATH . 'bundles/*/');

        foreach ($paths as $path) {
            $bundles[] = new static('bundle::'.basename($path));
        }

        return $bundles;
    }

    public static function path($view)
    {
        return PATH . $view . DS;
    }

}