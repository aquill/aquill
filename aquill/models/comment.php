<?php

class Comment extends Eloquent
{

    public static $table = 'comments';

    public static $timestamps = false;

    public static $rules = array(
        'name' => 'required',
        'email' => 'email',
        'content' => 'required',
    );

    public static function push($input)
    {
        if ($id = Input::get('id', 0)) {
            static::where('id', '=', $id)->update($input);
        }
    }

    public function date($format = 'Y-m-d H:i:s')
    {
        return date($format, strtotime($this->created_at));
    }
}