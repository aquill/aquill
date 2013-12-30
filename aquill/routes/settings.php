<?php

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your applications using Laravel's RESTful routing, and it
| is perfectly suited for building both large applications and simple APIs.
| Enjoy the fresh air and simplicity of the framework.
|
*/

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
