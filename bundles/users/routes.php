<?php

Autoloader::map(array(
    'User' => Bundle::path('users') . 'user.php',
));

Route::get('login', function () {
    if (Auth::check()) return Redirect::to('admin/posts');

    $vars['messages'] = Notify::read();

    return View::make('users::login', $vars);
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
            Notify::error('login failed.');
        }
    }

    return Redirect::to('login');
});

Route::get('logout', function () {
    Auth::logout();

    Notify::success('logout success.');

    return Redirect::to('login');
});

Route::get('(:bundle), (:bundle)/(:num)', function ($id = null) {
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

    return View::make('users::index', $vars)->nest('formdata', 'users::form', $data);
});

Route::post('(:bundle)', function () {
    if (Input::get('page') > User::count() / 20) {
        return;
    }

    $vars['users'] = User::paginate(20);

    return View::make('users::users', $vars);
});

Route::post('(:bundle)/new, (:bundle)/edit/(:num)', function ($id = null) {
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

    return Redirect::to_action('users::?id=' . $id);
});

Route::post('(:bundle)/delete/(:num)', function ($id) {
    if (!is_null($id)) User::delete($id);

    return Redirect::to_action('users::');
});