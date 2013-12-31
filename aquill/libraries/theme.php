<?php

class Theme extends View
{
    /**
     * Get the path to a given view on disk.
     *
     * @param  string $view
     * @return string
     */
    protected function path($view)
    {
        $view = str_replace('.', '/', $view);

        $root = PATH . 'themes/default/';

        // Views may have the normal PHP extension or the Blade PHP extension, so
        // we need to check if either of them exist in the base views directory
        // for the bundle and return the first one we find.
        foreach (array(EXT, BLADE_EXT) as $extension) {
            if (file_exists($path = $root . $view . $extension)) {
                return $path;
            }
        }

        throw new \Exception("View [$path] does not exist.");
    }

    public static function error($stauts)
    {
        return Response::make(static::make('404'), $stauts);
    }

}