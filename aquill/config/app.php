<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | The URL used to access your application without a trailing slash. The URL
    | does not have to be set. If it isn't we'll try our best to guess the URL
    | of your application.
    |
    */

    'url' => '',

    /*
    |--------------------------------------------------------------------------
    | Application Index
    |--------------------------------------------------------------------------
    |
    | If you are including the "index.php" in your URLs, you can ignore this.
    | However, if you are using mod_rewrite to get cleaner URLs, just set
    | this option to an empty string and we'll take care of the rest.
    |
    */

    'index' => 'index.php',

    /*
    |--------------------------------------------------------------------------
    | Application Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the encryption and cookie classes to generate secure
    | encrypted strings and hashes. It is extremely important that this key
    | remain secret and should not be shared with anyone. Make it about 32
    | characters of random gibberish.
    |
    | The "auto_key" option tells Laravel to automatically set this key value
    | if one has not already been set. This is generally done on the first
    | request to the Laravel splash screen.
    |
    */

    'key' => 'Dc2kDVWq6YXZeSC5IQfO3vWRmY7li7SZ',

    'auto_key' => true,

    /*
    |--------------------------------------------------------------------------
    | Application Character Encoding
    |--------------------------------------------------------------------------
    |
    | The default character encoding used by your application. This encoding
    | will be used by the Str, Text, Form, and any other classes that need
    | to know what type of encoding to use for your awesome application.
    |
    */

    'encoding' => 'UTF-8',

    /*
    |--------------------------------------------------------------------------
    | Application Language
    |--------------------------------------------------------------------------
    |
    | The default language of your application. This language will be used by
    | Lang library as the default language when doing string localization.
    |
    */

    'language' => 'en',

    /*
    |--------------------------------------------------------------------------
    | SSL Link Generation
    |--------------------------------------------------------------------------
    |
    | Many sites use SSL to protect their users data. However, you may not be
    | able to use SSL on your development machine, meaning all HTTPS will be
    | broken during development.
    |
    | For this reason, you may wish to disable the generation of HTTPS links
    | throughout your application. This option does just that. All attempts
    | to generate HTTPS links will generate regular HTTP links instead.
    |
    */

    'ssl' => true,

    /*
    |--------------------------------------------------------------------------
    | XSS Clean
    |--------------------------------------------------------------------------
    |
    | The filter, as mentioned above is very strict. It defaults to a high 
    | level of protection, and users who want to be more permissive with their 
    | input should be savvy enough to filter that input accordingly before 
    | rendering the content on the front end.
    |
    | The filter disallows the following HTML elements: meta, link, style, 
    | script, embed, object, iframe, frame, frameset, title, and a few other 
    | more obscure ones.
    |
    */

    'xss' => true,

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | The default timezone of your application. The timezone will be used when
    | Laravel needs a date, such as when writing to a log file or travelling
    | to a distant star at warp speed.
    |
    */

    'timezone' => 'UTC',

);