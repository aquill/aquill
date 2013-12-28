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

Route::get('admin/comments, admin/comments/(:num)', function ($id = null) {
    $vars['messages'] = Notify::read();

    $vars['comments'] = Comment::order_by('date', 'DESC')->paginate(10);

    if ($id = Input::get('id', 0)) {
        $data['comment'] = Comment::find($id);
    } else {
        $data['comment'] = new Comment;
    }

    $data['statuses'] = array(
        'approved' => __('Approved'),
        'pending' => __('Pending'),
        'spam' => __('Spam')
    );

    return View::make('comments/index', $vars)->nest('formdata', 'comments/form', $data);
});

Route::post('admin/comments', function () {
    if (Input::get('page') > Comment::count() / 20) {
        return;
    }

    $vars['comments'] = Comment::order_by('date', 'DESC')->paginate(20);

    return View::make('comments/comments', $vars);
});

Route::post('admin/comments/new, admin/comments/edit/(:num)', function ($id = null) {
    $start = microtime(true);

    if (is_null($id)) return Redirect::to('admin/comments');

    $input = Input::only(array('name', 'email', 'url', 'text', 'status'));

    $validation = Validator::make($input, Comment::$rules);

    if ($validation->valid()) { // if failed, auto notification error.
        Comment::update($id, $input);
        $time = number_format((microtime(true) - $start) * 1000, 2);
        Notify::success('comment updated time: ' . $time);
    }

    return Redirect::to("admin/comments?id={$id}");
});
