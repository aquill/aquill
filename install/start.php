<?php

require 'helpers.php';

Autoloader::map(array(
    'Notify' => PATH . 'aquill/libraries/notify.php',
    'Braces' => APP . 'libraries/braces.php'
));

Asset::bundle('install')->add('jquery', 'assets/css/style.css');

Asset::container('footer')->bundle('install')->add('jquery', 'assets/css/style.css');

