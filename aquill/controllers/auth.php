<?php

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) return Redirect::to('admin/posts');

        $vars['messages'] = Notify::read();

        return View::make('users/login', $vars);
    }

    public function check()
    {
        $credentials = Input::only(array('username', 'password'));

        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );

        $validation = Validator::make($credentials, $rules);

        if ($validation->valid()) {
            if (Auth::attempt($credentials)) {
                return Redirect::to('admin');
            } else {
                Notify::error(__('login.error'));
            }
        }

        return Redirect::to('login');
    }

    public function logout()
    {
        if (Auth::check()) Auth::logout();

        Notify::success(__('login.logout'));

        return Redirect::to('login');
    }

    public function amnesia()
    {
        $vars['messages'] = Notify::read();

        return View::make('users/amnesia', $vars);
    }
}