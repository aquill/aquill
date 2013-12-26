<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your applications using Laravel's RESTful routing, and it
| is perfectly suited for building both large applications and simple APIs.
| Enjoy the fresh air and simplicity of the framework.
|
*/

Route::get('/, home', function () {

    return View::make('home.index');
});

Route::get('admin/settings', function () {


    $vars['messages'] = Notify::read();

    $meta = DB::table('meta')->get();

    foreach ($meta as $m) {
        $vars[$m->key] = $m->value;
    }

    return View::make('extend/settings', $vars);
});

Route::get('admin/themes', function () {
    $vars['messages'] = Notify::read();

    $meta = DB::table('meta')->get();

    foreach ($meta as $m) {
        $vars[$m->key] = $m->value;
    }

    return View::make('extend/settings', $vars);
});

Route::get('admin/bundles', function () {
    $vars['messages'] = Notify::read();

    $meta = DB::table('meta')->get();

    foreach ($meta as $m) {
        $vars[$m->key] = $m->value;
    }

    return View::make('extend/settings', $vars);
});

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
    return Response::error('404');
});

Event::listen('500', function () {
    return Response::error('500');
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