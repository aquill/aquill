<?php

class Template extends View
{

    /**
     * Get the path to a given view on disk.
     *
     * @param  string $view
     * @return string
     */
    protected function path($view)
    {
        $root = PATH . 'themes' . DS . get_option('site_theme', 'default') . DS;

        if ($view == 'category' or $view == 'tag' or $view == 'search' or $view == '404') {
            if (!file_exists($path = $root . $view . EXT)) {
                $view = 'index';
            }
        }

        if (file_exists($path = $root . $view . EXT)) {
            return $path;
        }

        throw new \Exception("View [$path] does not exist.");
    }

}