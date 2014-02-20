<?php
class Tag extends Eloquent
{
    public static $table = 'terms';

    public static $timestamps = false;

    public static $titles = null;

    public static $names = null;

    public static function titles()
    {
        if (is_null(static::$titles)) {
            $terms = static::order_by('name', 'ASC')
                            ->where('taxonomy', '=', 'tag')
                            ->get();

            foreach ($terms as $term) {
                static::$titles[$term->id] = $term->name;
            }
        }
        
        return static::$titles;
    }

    public static function names()
    {
        if (is_null(static::$names)) {
            $terms = static::order_by('name', 'ASC')
                            ->where('taxonomy', '=', 'tag')
                            ->get();

            foreach ($terms as $term) {
                static::$names[$term->slug] = $term->name;
            }
        }
        
        return static::$names;
    }

    public static function push($input)
    {
        if ($id = Input::get('id', 0)) {
            static::where('id', '=', $id)->update($input);
        } else {
            $input['taxonomy'] = 'tag';
            $id = static::insert_get_id($input);
        }

        return $id;
    }

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->slug;
        return url(rewrite($patterns, __CLASS__));
    }

    public function name()
    {
        return $this->name;
    }

    public function title()
    {
        return $this->name;
    }

    public function slug()
    {
        return urldecode($this->slug);
    }

    public function posts()
    {
        return Post::join('relationships', 'posts.id', '=', 'relationships.post_id')
            ->where('relationships.term_id', '=', $this->id)
            ->where('status', '=', 'publish')
            ->where('type', '=', 'post')
            ->order_by('created_at', 'DESC')
            ->paginate(10);
    }
}