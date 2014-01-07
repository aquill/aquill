<?php

class Menu extends Eloquent
{
    public static $table = 'posts';

    public static $menu = null;

    public static function site()
    {
        return static::where('status', '=', 'publish')
                    ->where('type', '=', 'menu')
                    ->order_by('menu_order', 'ASC')->get();
    }

    public function link()
    {
        if (is_null($this->slug)) {
            return is_url($this->uri) ? $this->uri : url($this->uri);
        }

        if (!is_null($this->menu)) {
            return $this->menu->link();
        }

        if (stripos($this->slug, 'page-') === 0) {
            $id = ltrim($this->slug, 'page-');
            $page = Page::find($id);
            $this->menu = $page;

            return $page->link();
        }

        if (stripos($this->slug, 'category-') === 0) {
            $id = ltrim($this->slug, 'category-');
            $category = Category::find($id);
            $this->menu = $category;

            return $category->link();
        }
    }

    public function title()
    {
        if ($this->title) {
            return $this->title;
        }

        if (!is_null($this->menu)) {
            return $this->menu->title();
        }

        if (stripos($this->slug, 'page-') === 0) {
            $id = ltrim($this->slug, 'page-');
            $page = Page::find($id);
            $this->menu = $page;

            return $page->title();
        }

        if (stripos($this->slug, 'category-') === 0) {
            $id = ltrim($this->slug, 'category-');
            $category = Category::find($id);
            $this->menu = $category;

            return $category->title();
        }
    }
}