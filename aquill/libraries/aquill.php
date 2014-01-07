<?php

class Aquill
{
    public static function bundles($bundles)
    {
        foreach ($bundles as $bundle) {
            Bundle::register($bundle, array('auto' => true));
        }

        foreach (Bundle::$bundles as $bundle => $config) {
            if ($config['auto']) Bundle::start($bundle);
        }
    }

    public static function theme($theme = 'default')
    {
        if (is_readable($p = PATH . "themes/{$theme}/functions.php"))
            require $p;
    }
}