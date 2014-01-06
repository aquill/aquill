<?php

class AdminController extends Controller
{

    public function __construct()
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'csrf')->on('post');
    }

    public function index()
    {
        return Redirect::to('admin/dashboard');
    }

    public function dashboard()
    {
        return View::make('dashboard');
    }

}