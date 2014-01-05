<?php

class CategoryController extends AdminController
{

    public function index($id = null) {
        $vars['messages'] = Notify::read();

        $vars['categories'] = Category::order_by('name', 'ASC')->paginate(6);

        if ($id = Input::get('id', 0)) {
            $data['category'] = Category::find($id);
        } else {
            $data['category'] = new Category;
        }

        return View::make('categories/index', $vars)->nest('formdata', 'categories/form', $data);
    }

    public function paginate() {
        if (Input::get('page') > Category::count() / 20) return;

        $vars['categories'] = Category::order_by('name', 'ASC')->paginate(20);

        return View::make('categories/categories', $vars);
    }

    public function compose($id = null) {

        $start = microtime(true);

        $input = Input::only(array('name', 'slug', 'description'));

        $rules = array(
            'name' => 'required',
            'slug' => 'required'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->valid()) {
            Category::push($input);
            $time = number_format((microtime(true) - $start) * 1000, 2);
            Notify::success('category updated time: ' . $time);
        }

        return Redirect::to('admin/categories?id=' . $id);
    }

    public function delete($id = null) {
        if (!is_null($id)) Category::delete($id);

        return Redirect::to('admin/categories');
    }

}