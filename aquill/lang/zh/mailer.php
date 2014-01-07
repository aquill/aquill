<?php

return array(

    'title' => '邮件系统',
    'description' => '',

    'debug' => '调试模式',
    'debug_description' => 'Only check this if you are experiencing problems and would like more error reporting to occur. Uncheck this once you have finished debugging.',

    'default' => 'SMTP',

    'host' => '主机',
    'host_description' => 'If localhost doesn\'t work for you, check with your host for the SMTP hostname.',
    'port' => '端口',
    'port_description' => 'This is generally 25.',
    'secure' => '安全', 
    'secure_description' => 'Sets connection prefix for secure connections (prefix method must be supported by your PHP install and your SMTP host)', 
    'auth' => '验证', 
    'auth_description' => 'If checked, you must provide the SMTP username and password below', 
    'user' => '用户名',
    'user_description' => '用户名',
    'pass' => '密码',
    'pass_description' => '密码',

    'localhost' => 'localhost', // rename to the URL you want as origin of email

);