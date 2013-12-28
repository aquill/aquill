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

Route::get('admin/categories, admin/categories/(:num)', function ($id = null) {
    $vars['messages'] = Notify::read();

    $vars['categories'] = Category::order_by('title', 'ASC')->paginate(6);

    if ($id = Input::get('id', 0)) {
        $data['category'] = Category::find($id);
    } else {
        $data['category'] = new Category;
    }

    return View::make('categories/index', $vars)->nest('formdata', 'categories/form', $data);
});

Route::post('admin/categories', function () {
    if (Input::get('page') > Category::count() / 20) return;

    $vars['categories'] = Category::order_by('title', 'ASC')->paginate(20);

    return View::make('categories/categories', $vars);
});

Route::post('admin/categories/new, admin/categories/edit/(:num)', function ($id = null) {

    $start = microtime(true);

    if (is_null($id)) return Redirect::to('admin/categories');

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

    return Redirect::to('admin/categories?id=' . $id);
});

Route::post('admin/categories/delete/(:num)', function ($id = null) {
    if (!is_null($id)) Category::delete($id);

    return Redirect::to('admin/categories');
});
