<?php

Autoloader::map(array('Notify' => PATH . 'aquill/libraries/notify.php'));

Asset::bundle('install')->add('jquery', 'assets/css/style.css');

Asset::container('footer')->bundle('install')->add('jquery', 'assets/css/style.css');

require 'helpers.php';
