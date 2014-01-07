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

}