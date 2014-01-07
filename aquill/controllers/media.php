<?php

class MediaController extends AdminController
{

    public function index($id = null)
    {

        $vars['media'] = Media::inherits()
                        ->order_by('created_at', 'DESC')
                        ->paginate(30);

        return View::make('media/index', $vars);
    }

}