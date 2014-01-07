<?php

class Media extends Post
{

    public static function inherits()
    {
        return static::where('status', '=', 'inherit')
                    ->where('type', '=', 'attachment')
                    ->order_by('created_at', 'DESC');
    }

    public function image()
    {
        $src = asset($this->uri);
        list($width, $height, $type, $attr) = getimagesize(asset($this->uri));

        return "<img src=\"{$src}\" $attr>";
    }

    public static function push($input)
    {
        $input['title'] = Input::file('file.name');
        $input['slug'] = Input::file('file.name');
        $input['content'] = '';
        $input['excerpt'] = '';
        $input['author'] = Auth::user()->id;
        $input['status'] = 'inherit';
        $input['type'] = 'attachment';

        DB::table('posts')->insert_get_id($input);
    }

}