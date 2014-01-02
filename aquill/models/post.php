<?php

class Post extends Eloquent
{
    public static $table = 'posts';

    public static function find_by_slug($slug = null)
    {
        return static::where('slug', '=', urlencode(urldecode($slug)))->first();
    }

    public static function published()
    {
        return static::where('status', '=', 'publish')
                    ->where('type', '=', get_class())
                    ->order_by('created_at', 'DESC');
    }

    public static function drafts()
    {
        return static::where('status', '=', 'draft')
                    ->where('type', '=', __CLASS__)
                    ->order_by('created_at', 'DESC');
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function slug()
    {
        return urldecode($this->slug);
    }

    public function link()
    {
        $permalink['year'] = date('Y', strtotime($this->created_at));
        $permalink['month'] = date('m', strtotime($this->created_at));
        $permalink['day'] = date('d', strtotime($this->created_at));
        $permalink['name'] = $this->slug;
        $permalink['id'] = $this->id;
        $permalink['category'] = $this->category_slug();

        return url(rewrite($permalink));
    }

    public function date($format = 'Y-m-d H:i:s')
    {
        if (is_null($this->created_at)) {
            return date($format);
        }

        return date($format, strtotime($this->created_at));
    }

    public function category_slug()
    {
        return current($this->categories())->slug;
    }

    public function author()
    {
        return User::find($this->author);
    }

    public function author_name()
    {
        return $this->author()->nicename;
    }

    public function comments()
    {
        return $this->has_many('Comment' , 'post_id')
                    ->where('status', '=', 'approved')
                    ->paginate(10);
    }

    public function tags()
    {
        return $this->has_many_and_belongs_to('Tag', 'relationships', 'post_id', 'term_id')
                    ->where('taxonomy', '=','tag')
                    ->get();
    }

    public function categories()
    {
        return $this->has_many_and_belongs_to('Category', 'relationships', 'post_id', 'term_id')
                    ->where('taxonomy', '=','category')
                    ->get();
    }

}