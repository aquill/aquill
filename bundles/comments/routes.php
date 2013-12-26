<?php

Autoloader::map(array('Comment' => __DIR__.DS.'comment.php'));

Route::get('(:bundle), (:bundle)/(:num)', function ($id = null) {
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

    return View::make('comments::index', $vars)->nest('formdata', 'comments::form', $data);
});

Route::post('(:bundle)', function () {
    if (Input::get('page') > Comment::count() / 20) {
        return;
    }

    $vars['comments'] = Comment::order_by('date', 'DESC')->paginate(20);

    return View::make('comments::comments', $vars);
});

Route::post('admin/comments/new, admin/comments/edit/(:num)', function ($id = null) {
    $start = microtime(true);

    if (is_null($id)) return Redirect::to_action('comments::');

    $input = Input::only(array('name', 'email', 'url', 'text', 'status'));

    $validation = Validator::make($input, Comment::$rules);

    if ($validation->valid()) { // if failed, auto notification error.
        Comment::update($id, $input);
        $time = number_format((microtime(true) - $start) * 1000, 2);
        Notify::success('comment updated time: ' . $time);
    }

    return Redirect::to_action("comments::?id={$id}");
});
