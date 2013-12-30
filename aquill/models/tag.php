<?php
class Tag extends Eloquent
{
    public static $table = 'terms';

    public static $timestamps = false;

    public static function find_by_slug($slug = null)
    {
        return static::where('slug', '=', urlencode(urldecode($slug)))->first();
    }

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->slug;
        return url(rewrite($patterns, 'tag'));
    }

    public function posts()
    {
        return $this->has_many_and_belongs_to('Post', 'relationships', 'term_id', 'post_id')
                    ->paginate(10);
    }
}