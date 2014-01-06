<?php

class MediaController extends AdminController
{

    public function index($id = null)
    {
        return View::make('media/index');
    }

}