<?php

class User extends Eloquent
{

    public static $table = 'users';
    
    public static $timestamps = false;

    public static function find_by_username($username = null)
    {
        return static::where('username', '=', urlencode(urldecode($username)))->first();
    }

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->username;
        return url(rewrite($patterns, 'author'));
    }

    public function posts()
    {
        return $this->has_many('Post' , 'author_id')->paginate(10);
    }

}