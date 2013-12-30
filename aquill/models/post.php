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
        $permalink['category'] = $this->category_slug();

        return url(rewrite($permalink));
    }

    public function category_slug()
    {
        return Category::find($this->category)->slug;
    }

    public function author()
    {
        return User::find($this->author);
    }

    public function author_name()
    {
        return $this->author()->real_name;
    }

    public function comments()
    {
        return $this->has_many('Comment' , 'post_id');
    }

    public function tags()
    {
        return $this->has_many_and_belongs_to('Term', 'relationships');
    }

}