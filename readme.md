## Aquill via Laravel 

Aquill is a lightweight and elegant blog engine using Laravel 3.0.0. The Laravel core has modified. You can visit the simplified version [here](https://github.com/aquill/aquill/tree/master/laravel)

## Requirements

- Apache, nginx, or another compatible web server (e.g. GAE, SAE...).
- PHP 5.3.6+
- SQLite 3, MySQL 5.2+, PostgreSQL

If you’re not sure what version of PHP you have, create a new file, and paste the following in at the top of the page:

	<?php echo PHP_VERSION; // version.php

## Installation

1. Insure that you have the required components.
2. Download or clone Aqiull from Github.
3. Extract the Aquill archive and upload the contents to your web server.
4. Verify that the `aquill/config` and `aquill/storage` directory is writable.
5. Create a database for Aquill to install to. You may name it anything you like. The method for database creation varies depending on your webhost but may require using PHPMyAdmin. If you are unsure of how to create this, ask your host.
6. Navigate your browser to your Aquill installation URL.`http://yourdomain/[sub directory]`
7. Follow the installer instructions.
8. For security purposes, delete the `install` directory when you are done.

## Cleaner URLs

Most likely, you do not want Aquill URLs to contain "index.php". You can remove it using HTTP rewrite rules. If you are using Apache, make sure to enable mod_rewrite and create a `.htaccess` file like this one in your public directory:

    <IfModule mod_rewrite.c>
         RewriteEngine on

         RewriteCond %{REQUEST_FILENAME} !-f
         RewriteCond %{REQUEST_FILENAME} !-d

         RewriteRule ^(.*)$ index.php/$1 [L]
    </IfModule>

Is the `.htaccess` file above not working for you? Try this one:

    Options +FollowSymLinks
    RewriteEngine on

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d

    RewriteRule . index.php [L]
    
If you are using Nginx, make sure in your vhost file you have the try_files feature.

    location / {
        try_files $uri $uri/ /index.php?$args;
    }
    
SAE(Sina App Engine) don't support `.htaccess`, you need to modify the rewrite in your application `config.yaml` file.

    handle:
    - rewrite: if(!is_dir() && !is_file()) goto "index.php?%{QUERY_STRING}"

## Bundles

Bundles extend from Laravel 3. They are better than the blog plugins. A bundle can have it's own views, configuration, routes, migrations, tasks, and more. A bundle could be everything from a database ORM to a robust authentication system. I have made a revision and make the bundles friendly to activate and deactivate.

## Themes

Aquill theming is easy, all you need is some basic knowledge of HTML, CSS, JavaScript, and PHP. 

## Localization

Localization is the process of translating Aquill into different languages. the language files under the `aquill/lang`, `(:bandle)/lang` and `(:themes)/lang` directories.
