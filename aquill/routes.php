<?php

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/

Route::get('/, home', 'site@home');
Route::get('robots.txt', 'site@robots');
Route::get('(feed|rss|atom)', 'site@feed');
Route::get('sitemap.(:any)', 'site@sitemap');

Route::get(pattern('post'), 'site@post');
Route::get(pattern('page'), 'site@page');
Route::get(pattern('category'), 'site@category');
Route::get(pattern('tag'), 'site@tag');
Route::get(pattern('author'), 'site@author');

Route::post('comment', 'site@comment');

/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/posts, admin/posts/(:num)', 'post@index');

Route::post('admin/posts', 'post@paginate');
Route::post('admin/posts/new, admin/posts/edit/(:num)', 'post@compose');
Route::post('admin/posts/delete/(:num)', 'post@delete');

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/categories, admin/categories/(:num)', 'category@index');

Route::post('admin/categories', 'category@paginate');
Route::post('admin/categories/new, admin/categories/edit/(:num)', 'category@compose');
Route::post('admin/categories/delete/(:num)', 'category@delete');

/*
|--------------------------------------------------------------------------
| Comment Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/comments, admin/comments/(:num)', 'comment@index');
Route::post('admin/comments', 'comment@paginate');
Route::post('admin/comments/new, admin/comments/edit/(:num)', 'comment@update');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('login', 'user@login');
Route::post('login', 'user@check');
Route::get('logout', 'user@logout');

Route::get('admin/users, admin/users/(:num)', 'user@index');
Route::post('admin/users', 'user@paginate');
Route::post('admin/users/new, admin/users/edit/(:num)', 'user@update');
Route::post('admin/users/delete/(:num)', 'user@delete');

/*
|--------------------------------------------------------------------------
| Extend Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/settings', 'extend@settings');
Route::get('admin/themes', 'extend@themes');
Route::get('admin/bundles', 'extend@bundles');

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function () {
    return Response::error(404);
});

Event::listen('500', function () {
    return Response::error(500);
});


/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in "before" and "after" filters are called before and
| after every request to your application, and you may even create other
| filters that can be attached to individual routes.
|
*/

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
