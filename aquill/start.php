<?php

/*
|--------------------------------------------------------------------------
| Auto-Loader Mappings
|--------------------------------------------------------------------------
|
| Laravel uses a simple array of class to path mappings to drive the class
| auto-loader. This simple approach helps avoid the performance problems
| of searching through directories by convention.
|
| Registering a mapping couldn't be easier. Just pass an array of class
| to path maps into the "map" function of Autoloader. Then, when you
| want to use that class, just use it. It's simple!
|
*/

require 'helpers.php';
require PATH . 'themes/default/functions.php';

/*
|--------------------------------------------------------------------------
| Auto-Loader Directories
|--------------------------------------------------------------------------
|
| The Laravel auto-loader can search directories for files using the PSR-0
| naming convention. This convention basically organizes classes by using
| the class namespace to indicate the directory structure.
|
| So you don't have to manually map all of your models, we've added the
| models and libraries directories for you. So, you can model away and
| the auto-loader will take care of the rest.
|
*/

Autoloader::map(array(
    'AdminController' => APP . 'controllers/admin.php',
));

Autoloader::directories(array(
	APP . 'models',
	APP . 'libraries',
));

Asset::container('header')->add('global', 'assets/css/global.css');
Asset::container('header')->add('admin', 'assets/css/admin.css');

Asset::container('header')->add('jquery', 'assets/js/jquery.js');
Asset::container('header')->add('autosize', 'assets/js/autosize.js');
Asset::container('header')->add('app', 'assets/js/app.js');
Asset::container('header')->add('selecter', 'assets/js/selecter.js');
Asset::container('header')->add('datetimepicker', 'assets/js/datetimepicker.js');
Asset::container('header')->add('marked', 'assets/js/marked.js');

Asset::container('footer')->add('marked', 'assets/js/checker.js');
