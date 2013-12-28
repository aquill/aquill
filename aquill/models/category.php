<?php 

class Category extends Eloquent
{

    public static $table = 'categories';

    public static $timestamps = false;

    public static function titles() {
        $titles = array();
        $categories = static::order_by('title', 'ASC')->get();
        foreach ($categories as $category) {
            $titles[$category->id] = $category->title;
        }
        return $titles;
    }
}