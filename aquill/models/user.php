<?php

class User extends Eloquent
{

    public static $table = 'users';
    
    public static $timestamps = false;

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