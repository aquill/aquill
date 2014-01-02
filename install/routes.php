<?php

// --------------------------------------------------------------
// Install Routes
// --------------------------------------------------------------

Route::get('/', 'installer@home');
Route::get('start', 'installer@start');
Route::get('database', 'installer@database');
Route::get('metadata', 'installer@metadata');
Route::get('rewrite', 'installer@rewrite');
Route::get('account', 'installer@account');
Route::get('complete', 'installer@complete');

Route::post('start', 'installer@start');
Route::post('database', 'installer@database');
Route::post('metadata', 'installer@metadata');
Route::post('rewrite', 'installer@rewrite');
Route::post('account', 'installer@account');

// --------------------------------------------------------------
// Application 404 & 500 Error Handlers
// --------------------------------------------------------------

Event::listen('404', function () {
    return Response::error('404');
});

Event::listen('500', function () {
    return Response::error('500');
});

// --------------------------------------------------------------
// Route Filters
// --------------------------------------------------------------

Route::filter('csrf', function () {
    if (Request::forged()) return Response::error('500');
});

Route::filter('check', function () {
    if (!is_writable(PATH . 'aquill/config')) {
        $vars['messages'] = _i('install.not_writeable');
        return Response::view('halt', $vars);
    }
});
