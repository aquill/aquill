<?php

// --------------------------------------------------------------
// Autoloader Classes
// --------------------------------------------------------------

Autoloader::map(array('AdminController' => APP . 'controllers/admin.php',));
Autoloader::directories(array(APP . 'models', APP . 'libraries',));

// --------------------------------------------------------------
// Configure Application Settings
// --------------------------------------------------------------

Config::set('app.index', get_option('site_index'));
Config::set('app.language', get_option('language'));
Config::set('app.timezone', get_option('timezone'));

// --------------------------------------------------------------
// Configure SMTP Settings
// --------------------------------------------------------------

Config::set('smtp.debug', get_option('smtp_debug'));
Config::set('smtp.connections.primary.host', get_option('smtp_host'));
Config::set('smtp.connections.primary.port', get_option('smtp_port'));
Config::set('smtp.connections.primary.secure', get_option('smtp_secure'));
Config::set('smtp.connections.primary.auth', get_option('smtp_auth'));
Config::set('smtp.connections.primary.user', get_option('smtp_user'));
Config::set('smtp.connections.primary.pass', get_option('smtp_pass'));
Config::set('smtp.localhost', get_option('smtp_localhost'));

// --------------------------------------------------------------
// Assets
// --------------------------------------------------------------

Asset::container('header')->add('global', 'assets/css/global.css');
Asset::container('header')->add('admin', 'assets/css/admin.css');
Asset::container('header')->add('color', 'assets/css/colors/'.get_option('site_color').'.css');

Asset::container('header')->add('jquery', 'assets/js/jquery.js');
Asset::container('header')->add('autosize', 'assets/js/autosize.js');
Asset::container('header')->add('app', 'assets/js/app.js');
Asset::container('header')->add('selecter', 'assets/js/selecter.js');
Asset::container('header')->add('datetimepicker', 'assets/js/datetimepicker.js');
Asset::container('header')->add('marked', 'assets/js/marked.js');

Asset::container('footer')->add('marked', 'assets/js/checker.js');

// --------------------------------------------------------------
// Loading Aquill
// --------------------------------------------------------------

$bundles = explode(',', get_option('site_bundles'));
$theme = get_option('site_theme', 'default');

Aquill::bundles($bundles);

Aquill::theme($theme);