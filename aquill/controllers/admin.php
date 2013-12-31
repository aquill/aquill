<?php

class AdminController extends Controller
{

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

}