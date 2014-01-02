<?php
/**
 * Aquill - A lightweight and elegant blogging engine.
 *
 * @package  Aquill
 * @version  1.0.0
 * @author   Aquill Team <aquill.org@gmail.com>
 * @link     http://aquill.org
 */

// --------------------------------------------------------------
// Tick... Tock... Tick... Tock...
// --------------------------------------------------------------
define('LARAVEL_START', microtime(true));

// --------------------------------------------------------------
// Aquill's version.
// --------------------------------------------------------------
define('AQUILL_VERSION', '0.0.1 alpha');

// --------------------------------------------------------------
// Define the directory separator for the environment.
// --------------------------------------------------------------
define('DS', DIRECTORY_SEPARATOR);

// --------------------------------------------------------------
// Define the path to the base directory.
// --------------------------------------------------------------
define('PATH', dirname(__FILE__) . DS);

// --------------------------------------------------------------
// The basic application.
// --------------------------------------------------------------

if (is_readable(PATH . 'aquill/config/database.php')) {
    define('DEFAULT_BUNDLE', 'aquill');
} else {
    define('DEFAULT_BUNDLE', 'install');
}

// --------------------------------------------------------------
// The path to the application directory.
// --------------------------------------------------------------
define('APP', PATH . DEFAULT_BUNDLE . DS);

// --------------------------------------------------------------
// The path to the Laravel directory.
// --------------------------------------------------------------
define('SYS', PATH . 'laravel' . DS);

// --------------------------------------------------------------
// The path to the bundles directory.
// --------------------------------------------------------------
define('BUNDLE', PATH . 'bundles' . DS);

// --------------------------------------------------------------
// The path to the storage directory.
// --------------------------------------------------------------
define('STORAGE', APP . 'storage' . DS);

// --------------------------------------------------------------
// The basic application.
// --------------------------------------------------------------
define('EXT', '.php');

// --------------------------------------------------------------
// Launch Aquill.
// --------------------------------------------------------------
require SYS . 'start' . EXT;
