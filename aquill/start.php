<?php

Autoloader::map(array('AdminController' => APP . 'controllers/admin.php',));
Autoloader::directories(array( APP . 'models', APP . 'libraries',));


$bundles = explode(',', get_option('site_bundles'));
$theme = get_option('site_theme', 'default');

Aquill::bundles($bundles);

Aquill::theme($theme);


Asset::container('header')->add('global', 'assets/css/global.css');
Asset::container('header')->add('admin', 'assets/css/admin.css');

Asset::container('header')->add('jquery', 'assets/js/jquery.js');
Asset::container('header')->add('autosize', 'assets/js/autosize.js');
Asset::container('header')->add('app', 'assets/js/app.js');
Asset::container('header')->add('selecter', 'assets/js/selecter.js');
Asset::container('header')->add('datetimepicker', 'assets/js/datetimepicker.js');
Asset::container('header')->add('marked', 'assets/js/marked.js');

Asset::container('footer')->add('marked', 'assets/js/checker.js');
