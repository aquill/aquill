<?php

class Post extends Eloquent
{
    public static $table = 'posts';

    public static function find_by_slug($slug = null)
    {
        return static::where('slug', '=', urlencode(urldecode($slug)))->first();
    }

    public function url()
    {
        $permalink['year'] = date('Y',strtotime($this->created));
        $permalink['month'] = date('m',strtotime($this->created));
        $permalink['day'] = date('d',strtotime($this->created));
        $permalink['name'] = $this->slug;
        $permalink['id'] = $this->id;

        return url(permalink($permalink));
    }

    public function author()
    {
        return User::find($this->author);
    }

    public function author_name()
    {
        return $this->author()->real_name;
    }

}