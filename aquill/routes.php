<?php

// --------------------------------------------------------------
// Site Routes
// --------------------------------------------------------------

Route::get('test', function() {
            if (Schema::hasTable('posts4'))
            Schema::drop('posts4');

        Schema::create('posts4', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('author')->default(1);
            $table->string('title');
            $table->string('slug')->default('');
            $table->text('content');
            $table->text('excerpt')->default('');
            $table->enum('status', array('publish', 'draft', 'inherit'))->default('publish');
            $table->enum('type', array('post', 'page', 'revision', 'menu', 'attachment'))->default('post');
            $table->string('password')->default('');
            $table->timestamps();
            $table->integer('parent')->default(0);
            $table->string('guid')->default('');
            $table->string('mime')->default('');
            $table->integer('menu_order')->default(0);
            $table->boolean('comment_status')->default(0);
            $table->integer('comment_count')->default(0);
        });
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
Route::get('admin/posts/delete/(:num)', 'post@delete');

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

Route::any('admin/(:all)', function ($id) {
    return Response::error(404);
});

Event::listen('404', function () {
    return Theme::notFound();
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
