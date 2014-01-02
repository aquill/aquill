<?php

require 'helpers.php';

Autoloader::map(array(
    'Notify' => PATH . 'aquill/libraries/notify.php',
    'Braces' => APP . 'libraries/braces.php'
));

Asset::container('header')->add('global', 'assets/css/global.css');
Asset::container('header')->add('install', 'install/assets/css/install.css');

Asset::container('header')->add('jquery', 'assets/js/jquery.js');
Asset::container('header')->add('autosize', 'assets/js/autosize.js');
Asset::container('header')->add('app', 'assets/js/app.js');
Asset::container('header')->add('selecter', 'assets/js/selecter.js');
Asset::container('header')->add('datetimepicker', 'assets/js/datetimepicker.js');
Asset::container('header')->add('marked', 'assets/js/marked.js');

Asset::container('footer')->add('marked', 'assets/js/checker.js');
