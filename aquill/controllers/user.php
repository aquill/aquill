<?php

class UserController extends AdminController
{
    public function index($id = null)
    {
        $data['messages'] = Notify::read();

        $vars['users'] = User::paginate(6);

        if ($id = Input::get('id', 0)) {
            $data['user'] = User::find($id);
        } else {
            $data['user'] = new User;
        }

        $vars['roles'] = $data['roles'] = array(
            'administrator' => __('user.administrator'),
            'editor' => __('user.editor'),
            'author' => __('user.author'),
            'contributor' => __('user.contributor'),
            'subscriber' => __('user.subscriber'),
            'pending' => __('user.pending'),
        );

        return View::make('users/index', $vars)->nest('formdata', 'users/form', $data);
    }

    public function paginate()
    {
        if (Input::get('page') > User::count() / 20) {
            return;
        }

        $vars['users'] = User::paginate(20);

        return View::make('users/users', $vars);
    }

    public function update($id = null)
    {
        $start = microtime(true);
        $input = Input::only(array('nicename', 'bio', 'status', 'role',
            'username', 'url', 'email'));

        $password = Input::get('password');
        $confirm = Input::get('confirm');

        if (!empty($password)) {
            if ($password == $confirm) {
                $input['password'] = Hash::make($password);
            } else {
                Notify::error(__('user.password_error'));
                return Redirect::to('admin/users?id=' . $id);
            }
        }

        $rules = array(
            'username' => 'required',
            'email' => 'required|email'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->invalid()) {
            Notify::error(__('user.error'));
            return Redirect::to('admin/users?id=' . $id);
        }
        
        $id = User::push($input);
        $time = number_format((microtime(true) - $start) * 1000, 2);
        Notify::success('user updated time: ' . $time);

        return Redirect::to('admin/users?id=' . $id);
    }

    public function delete($id)
    {
        if (!is_null($id)) User::delete($id);

        return Redirect::to('admin/users');
    }

}
