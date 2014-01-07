<?php

return array(

    'title' => 'Configure SMTP Settings',
    'description' => '',

    'debug' => 'Debug mode',
    'debug_description' => 'Only check this if you are experiencing problems and would like more error reporting to occur. Uncheck this once you have finished debugging.',

    'default' => 'SMTP',

    'host' => 'Host',
    'host_description' => 'If localhost doesn\'t work for you, check with your host for the SMTP hostname.',
    'port' => 'Port',
    'port_description' => 'This is generally 25.',
    'secure' => 'Secure', 
    'secure_description' => 'Sets connection prefix for secure connections (prefix method must be supported by your PHP install and your SMTP host)', 
    'auth' => 'Auth', 
    'auth_description' => 'If checked, you must provide the SMTP username and password below', 
    'user' => 'Username',
    'user_description' => 'Username',
    'pass' => 'Password',
    'pass_description' => 'Password',

    'localhost' => 'localhost', // rename to the URL you want as origin of email

);