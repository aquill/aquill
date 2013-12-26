<?php

Route::get('(:bundle), (:bundle)/(:num)', function ($id = null) {
    $vars['messages'] = Notify::read();

    $vars['categories'] = Category::order_by('title', 'ASC')->paginate(6);

    if ($id = Input::get('id', 0)) {
        $data['category'] = Category::find($id);
    } else {
        $data['category'] = new Category;
    }

    return View::make('categories::index', $vars)->nest('formdata', 'categories::form', $data);
});

Route::post('(:bundle)', function () {
    if (Input::get('page') > Category::count() / 20) return;

    $vars['categories'] = Category::order_by('title', 'ASC')->paginate(20);

    return View::make('categories::categories', $vars);
});

Route::post('(:bundle)/new, (:bundle)/edit/(:num)', function ($id = null) {

    $start = microtime(true);

    if (is_null($id)) return Redirect::to_action('categories::');

    $input = Input::only(array('title', 'slug', 'description'));

    $rules = array(
        'title' => 'required',
        'slug' => 'required'
    );

    $validation = Validator::make($input, $rules);

    if ($validation->valid()) {
        Category::update($id, $input);
        $time = number_format((microtime(true) - $start) * 1000, 2);
        Notify::success('category updated time: ' . $time);
    }

    return Redirect::to_action('categories::?id=' . $id);
});

Route::post('(:bundle)/delete/(:num)', function ($id = null) {
    if (!is_null($id)) Category::delete($id);

    return Redirect::to_action('categories::');
});
