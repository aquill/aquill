<?php 

class Category extends Tag
{

    public static $titles = null;

    public static function titles()
    {
        if (is_null(static::$titles)) {
            $terms = static::order_by('name', 'ASC')
                            ->where('taxonomy', '=', 'category')
                            ->get();

            foreach ($terms as $term) {
                static::$titles[$term->id] = $term->name;
            }
        }
        
        return static::$titles;
    }

    public static function push($input)
    {
        if ($id = Input::get('id', 0)) {
            static::where('id', '=', $id)->update($input);
        } else {
            $input['taxonomy'] = 'category';
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

}