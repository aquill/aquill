<?php

class UserController extends AdminController
{
    public function index($id = null) {
        $vars['messages'] = Notify::read();

        $vars['users'] = User::paginate(6);

        if ($id = Input::get('id', 0)) {
            $data['user'] = User::find($id);
        } else {
            $data['user'] = new User;
        }

        $data['roles'] = array(
            'administrator' => __('user.administrator'),
            'editor' => __('user.editor'),
            'author' => __('user.author'),
            'contributor' => __('user.contributor'),
            'subscriber' => __('user.subscriber'),
            'pending' => __('user.pending'),
        );

        return View::make('users/index', $vars)->nest('formdata', 'users/form', $data);
    }

    public function paginate() {
        if (Input::get('page') > User::count() / 20) {
            return;
        }

        $vars['users'] = User::paginate(20);

        return View::make('users/users', $vars);
    }

    public function update($id = null) {
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
    }

    public function delete($id) {
        if (!is_null($id)) User::delete($id);

        return Redirect::to('admin/users');
    }

}
