<?php

class Post extends Eloquent
{
    public static $table = 'posts';

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

    public static function delete($id) {
        DB::table('posts')->delete($id);
        DB::table('relationships')->delete(array('post_id' => $id));
        DB::table('comments')->delete(array('post_id' => $id));
    }

    public static function save($input)
    {
        $author = Input::get('author', Auth::user()->id);
        $cids = Input::get('category');

        if ($id = Input::get('id', 0)) {
            static::where('id', '=', $id)->update($input);
            DB::table('relationships')->delete(array('post_id' => $id));
        } else {
            $id = DB::table('posts')->insert_get_id($input);
        }

        foreach ($cids as $cid) {
            DB::table('relationships')->insert(array('post_id' => $id, 'term_id' => $cid));
        }

        return $id;
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
        return Comment::where('post_id', '=', $this->id)
            ->where('status', '=','approved')
            ->paginate(10);
    }

    public function tags()
    {
        return Tag::join('relationships', 'terms.id', '=', 'relationships.term_id')
            ->where('relationships.post_id', '=', $this->id)
            ->where('taxonomy', '=','tag')
            ->get();
    }

    public function categories()
    {
        return Category::join('relationships', 'terms.id', '=', 'relationships.term_id')
            ->where('relationships.post_id', '=', $this->id)
            ->where('taxonomy', '=','category')
            ->get();
    }

    public function cids()
    {
        $keys = array_keys($this->categories());

        if (empty($keys)) return 1;

        return $keys;
    }

}