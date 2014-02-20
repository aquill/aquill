<?php

// --------------------------------------------------------------
// Site Routes
// --------------------------------------------------------------

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
Route::post('admin/posts/new, admin/posts/edit/(:num)', 'post@push');

Route::get('admin/posts/publish/(:num)', 'post@publish');
Route::get('admin/posts/draft/(:num)', 'post@draft');
Route::get('admin/posts/delete/(:num)', 'post@delete');

// --------------------------------------------------------------
// Tag Routes
// --------------------------------------------------------------

Route::get('admin/tags, admin/tags/(:num)', 'category@index');

Route::post('admin/tags', 'category@paginate');
Route::post('admin/tags/new, admin/tags/edit/(:num)', 'category@compose');
Route::get('admin/tags/delete/(:num)', 'category@delete');

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
Route::get('admin/users/delete/(:num)', 'user@delete');

// --------------------------------------------------------------
// Media Routes
// --------------------------------------------------------------

Route::get('admin/media', 'media@index');
Route::post('admin/media/upload', 'media@upload');

// --------------------------------------------------------------
// Extend Routes
// --------------------------------------------------------------

Route::get('admin', 'admin@index');
Route::get('admin/dashboard', 'admin@dashboard');

Route::get('admin/general', 'extend@general');
Route::get('admin/urls', 'extend@urls');
Route::get('admin/mailer', 'extend@mailer');
Route::get('admin/themes', 'extend@themes');
Route::get('admin/bundles', 'extend@bundles');

Route::post('admin/general', 'extend@general');
Route::post('admin/urls', 'extend@urls');
Route::post('admin/mailer', 'extend@mailer');
Route::post('admin/themes/(:any)', 'extend@themes');
Route::post('admin/bundles/(:any)', 'extend@bundles');

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
