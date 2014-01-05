<?php

class User extends Eloquent
{

    public static $table = 'users';
    
    public static $timestamps = false;

    public static function push($input)
    {
        if ($id = Input::get('id', 0)) {
            $passwords = Input::only(array());
            static::where('id', '=', $id)->update($input);
        } else {
            $input['registered'] = date('Y-m-d H:i:s');
            $id = DB::table('users')->insert_get_id($input);
        }

        return $id;
    }

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->username;
        return url(rewrite($patterns, 'author'));
    }

    public function posts()
    {
        return Post::where('author', '=', $this->id)
            ->where('status', '=', 'publish')
            ->where('type', '=', 'post')
            ->order_by('created_at', 'DESC')
            ->paginate(10);
    }

}