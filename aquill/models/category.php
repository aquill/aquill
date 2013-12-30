<?php 

class Category extends Tag
{

    public static function titles()
    {
        $titles = array();
        $categories = static::order_by('name', 'ASC')->get();
        foreach ($categories as $category) {
            $titles[$category->id] = $category->name;
        }
        return $titles;
    }

    public function link()
    {
        $patterns['id'] = $this->id;
        $patterns['name'] = $this->slug;
        return url(rewrite($patterns, 'category'));
    }

}