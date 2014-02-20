<?php

class Page extends Post
{

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->slug;

        return url(rewrite($patterns, 'page'));
    }

    public static function published()
    {
        return static::where('status', '=', 'publish')
                    ->where('type', '=', 'page')
                    ->order_by('created_at', 'DESC');
    }

}