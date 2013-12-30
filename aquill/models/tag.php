<?php
class Tag extends Eloquent
{
    public static $table = 'terms';

    public static $timestamps = false;

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->slug;
        return url(rewrite($patterns, 'tag'));
    }
}