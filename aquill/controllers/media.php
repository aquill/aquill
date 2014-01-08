<?php

class MediaController extends AdminController
{

    public function index($id = null)
    {
        $vars['media'] = Media::inherits()
                        ->order_by('created_at', 'DESC')
                        ->paginate(50);

        return View::make('media/index', $vars);
    }

    public function upload()
    {
        $extension = strtolower(File::extension(Input::file('file.name')));
        $uri = 'aquill/storage/media/'.date('Y/m/');
        $path = PATH . $uri;

        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        $mime = File::mime($extension);
        $uri = $uri . Str::random(20, 'digital') . '.' . $extension;
        $path = PATH . $uri;

        $input['mime'] = $mime;
        $input['uri'] = $uri;
        
        $index = Input::get('index');
        $src = asset($uri);
        $date = $input['created_at'] = $input['updated_at'] = date('Y-m-d H:i:s');

        Media::push($input);
        Input::upload('file', $path);

        return;
    }

}