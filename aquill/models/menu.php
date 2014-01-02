<?php

class Menu extends Eloquent
{
    public static $table = 'posts';

    public static function site()
    {
        return static::where('status', '=', 'publish')
                    ->where('type', '=', 'menu')
                    ->order_by('menu_order', 'ASC')->get();
    }

    public function link()
    {
        if ($this->guid) {
            return is_url($this->guid) ? $this->guid : url($this->guid);
        }

        if (is_numeric($this->slug)) {
            $page = Page::find($this->slug);
            return $page->link();
        }

        if (is_string($this->slug)) {
            $category = Category::find_by_slug($this->slug);
            return $category->link();
        }
    }

    public function title()
    {
        if ($this->title) {
            return $this->title;
        }

        if (is_numeric($this->slug)) {
            $page = Page::find($this->slug);
            return $page->title;
        }

        if (is_string($this->slug)) {
            $category = Category::find_by_slug($this->slug);
            return $category->name;
        }
    }
}