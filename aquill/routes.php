<?php

// --------------------------------------------------------------
// Site Routes
// --------------------------------------------------------------
Route::get('wp2aquill', function () {

    Create::all();

    $database1 = 'blog';
    $prefix1 = 'aquill_';
    $database2 = 'arain';
    $prefix2 = 'wp_';

    $sql_posts = "
        INSERT INTO `{$database1}`.`{$prefix1}posts`(`id`, `author`, `title`, `slug`, `content`, `excerpt`, `status`, `password`, `created_at`, `updated_at`, `parent`, `guid`, `mime`, `type`, `menu_order`, `comment_status`, `comment_count`) 
        SELECT `ID`, `post_author`, `post_title`, `post_name`, `post_content`, `post_excerpt`, `post_status`, `post_password`, `post_date`, `post_modified`, `post_parent`, `guid`, `post_mime_type`, `post_type`, `menu_order`, `comment_status`, `comment_count` 
        FROM `{$database2}`.`{$prefix2}posts`";

    $sql_terms = "
        INSERT INTO `{$database1}`.`{$prefix1}terms`(`id`, `name`, `slug`, `taxonomy`, `description`, `parent`, `count`)
        SELECT `{$prefix2}terms`.`term_id`, `name`, `slug`, `taxonomy`, `description`, `parent`, `count` 
        FROM `{$database2}`.`{$prefix2}terms` 
        JOIN `{$database2}`.`{$prefix2}term_taxonomy` 
        ON `{$database2}`.`{$prefix2}terms`.`term_id` = `{$database2}`.`{$prefix2}term_taxonomy`.`term_id` 
        GROUP BY `{$database2}`.`{$prefix2}terms`.`term_id`";

    $sql_relationships = "
        INSERT INTO `{$database1}`.`{$prefix1}relationships`(`post_id`, `term_id`) 
        SELECT `object_id`, `term_taxonomy_id` 
        FROM `{$database2}`.`{$prefix2}term_relationships` ";

    $sql_comments = "
        INSERT INTO `{$database1}`.`{$prefix1}comments`(`id`, `post_id`, `name`, `email`, `url`, `ip`, `created_at`, `content`, `karma`, `approved`, `agent`, `type`, `parent`, `uesr_id`)
        SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id` 
        FROM `{$database2}`.`{$prefix2}comments`";

    $sql_users = "
        INSERT INTO `{$database1}`.`{$prefix1}users`(`id`, `username`, `password`, `nicename`, `email`, `url`, `registered`, `activation_key`, `status`, `role`)
        SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, 'administrator' 
        FROM `{$database2}`.`{$prefix2}users`";

    DB::connection()->query($sql_posts);
    DB::connection()->query($sql_terms);
    DB::connection()->query($sql_relationships);
    DB::connection()->query($sql_comments);
    DB::connection()->query($sql_users);

    echo exec_time();
});


Route::get('/, home', 'site@home');
Route::get('robots.txt', 'site@robots');
Route::get('(feed|rss|atom)', 'site@feed');
Route::get('sitemap.(:any)', 'site@sitemap'); //xml, text, html, ror-rss, ror-rdf

Route::get(pattern('post'), 'site@post');
Route::get(pattern('page'), 'site@page');
Route::get(pattern('category'), 'site@category');
Route::get(pattern('tag'), 'site@tag');
Route::get(pattern('author'), 'site@author');

Route::post('comment', 'site@comment');

// --------------------------------------------------------------
// Post Routes
// --------------------------------------------------------------

Route::get('admin/posts, admin/posts/(:num)', 'post@index');

Route::post('admin/posts', 'post@paginate');
Route::post('admin/posts/new, admin/posts/edit/(:num)', 'post@compose');
Route::post('admin/posts/delete/(:num)', 'post@delete');

// --------------------------------------------------------------
// Category Routes
// --------------------------------------------------------------

Route::get('admin/categories, admin/categories/(:num)', 'category@index');

Route::post('admin/categories', 'category@paginate');
Route::post('admin/categories/new, admin/categories/edit/(:num)', 'category@compose');
Route::post('admin/categories/delete/(:num)', 'category@delete');

// --------------------------------------------------------------
// Comment Routes
// --------------------------------------------------------------

Route::get('admin/comments, admin/comments/(:num)', 'comment@index');
Route::post('admin/comments', 'comment@paginate');
Route::post('admin/comments/new, admin/comments/edit/(:num)', 'comment@update');

// --------------------------------------------------------------
// User Routes
// --------------------------------------------------------------

Route::get('login', 'auth@login');
Route::post('login', 'auth@check');
Route::get('logout', 'auth@logout');
Route::get('amnesia', 'auth@amnesia');

Route::get('admin/users, admin/users/(:num)', 'user@index');
Route::post('admin/users', 'user@paginate');
Route::post('admin/users/new, admin/users/edit/(:num)', 'user@update');
Route::post('admin/users/delete/(:num)', 'user@delete');

// --------------------------------------------------------------
// Extend Routes
// --------------------------------------------------------------

Route::get('admin/settings', 'extend@settings');
Route::get('admin/themes', 'extend@themes');
Route::get('admin/bundles', 'extend@bundles');

// --------------------------------------------------------------
// Application 404 & 500 Error Handlers
// --------------------------------------------------------------

Route::get('admin/(:all)', function ($id) {
    return Response::error(404);
});

Event::listen('404', function () {
    return Theme::make('404');
});

Event::listen('500', function () {
    return Response::error(500);
});

// --------------------------------------------------------------
// Route Filters
// --------------------------------------------------------------

Route::filter('before', function () {
    // Do stuff before every request to your application...
});

Route::filter('after', function ($response) {
    // Do stuff after every request to your application...
});

Route::filter('csrf', function () {
    if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function () {
    if (Auth::guest()) return Redirect::to('login');
});
