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

Route::get('login', function () {
    if (Auth::check()) return Redirect::to('admin/posts');

    $vars['messages'] = Notify::read();

    return View::make('users/login', $vars);
});

Route::post('login', function () {
    $credentials = Input::only(array('username', 'password'));

    $rules = array(
        'username' => 'required',
        'password' => 'required'
    );

    $validation = Validator::make($credentials, $rules);

    if ($validation->valid()) {
        if (Auth::attempt($credentials)) {
            return Redirect::to('admin/posts');
        } else {
            $credentials['messages'] = 'login failed.';
        }
    }

    return Response::view('users/login', $credentials);
});

Route::get('logout', function () {
    Auth::logout();

    Notify::success('logout success.');

    return Redirect::to('login');
});

Route::get('admin/users, admin/users/(:num)', function ($id = null) {
    $vars['messages'] = Notify::read();

    $vars['users'] = User::paginate(6);

    if ($id = Input::get('id', 0)) {
        $data['user'] = User::find($id);
    } else {
        $data['user'] = new User;
    }

    $data['statuses'] = array(
        'inactive' => __('Inactive'),
        'active' => __('Active')
    );

    $data['roles'] = array(
        'administrator' => __('Administrator'),
        'editor' => __('Editor'),
        'user' => __('User')
    );

    return View::make('users/index', $vars)->nest('formdata', 'users/form', $data);
});

Route::post('admin/users', function () {
    if (Input::get('page') > User::count() / 20) {
        return;
    }

    $vars['users'] = User::paginate(20);

    return View::make('users/users', $vars);
});

Route::post('admin/users/new, admin/users/edit/(:num)', function ($id = null) {
    $start = microtime(true);
    $input = Input::only(array('real_name', 'bio', 'status', 'role',
        'username', 'password', 'email'));

    $rules = array(
        'real_name' => 'required',
        'username' => 'required',
        'email' => 'required|email'
    );

    $validation = Validator::make($input, $rules);

    if ($validation->valid()) {
        User::update($id, $input);
        $time = number_format((microtime(true) - $start) * 1000, 2);
        Notify::success('user updated time: ' . $time);
    }

    return Redirect::to('admin/users?id=' . $id);
});

Route::post('admin/users/delete/(:num)', function ($id) {
    if (!is_null($id)) User::delete($id);

    return Redirect::to('admin/users');
});