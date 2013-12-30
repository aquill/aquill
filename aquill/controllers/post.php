<?php

class PostController extends AdminController
{
    public function index($id = null) {
        $vars['messages'] = Notify::read();
        $vars['posts'] = Post::order_by('created', 'DESC')->paginate(10);

        $data['statuses'] = array(
            'published' => __('published'),
            'draft' => __('draft'),
            'archived' => __('archived')
        );
        
        $data['categories'] = Category::titles();

        if ($id != null) {
            $data['post'] = Post::find($id);
        } else {
            $data['post'] = new Post;
        }

        return View::make('posts/index', $vars)->nest('formdata', 'posts/form', $data);
    }

    public function paginate() {
        if (Input::get('page') > Post::count() / 10) {
            return;
        }
        $vars['posts'] = Post::order_by('created', 'DESC')->paginate(10);

        return View::make('posts/posts', $vars);
    }

    public function compose($id = null) {
        $start = microtime(true);
        $input = Input::only(array('title', 'slug', 'created',
            'html', 'category', 'status'));

        $input['comments'] = Input::get('comments', 0);

        if (empty($input['slug'])) {
            $input['slug'] = urlencode($input['title']);
        } else {
            $input['slug'] = urlencode($input['slug']);
        }

        $rules = array(
            'title' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->valid()) {

            if (is_null($id)) {
                $new = Post::create($input);
                $time = number_format((microtime(true) - $start) * 1000, 2);
                Notify::success('post created time: ' . $time);
                $id = $new->id;
            } else {
                Post::update($id, $input);
                $time = number_format((microtime(true) - $start) * 1000, 2);
                Notify::success('post updated time: ' . $time);
            }
        }

        return Redirect::to('admin/posts' . $id);
    }

    public function delete($id) {
        if (!is_null($id)) Post::delete($id);

        return Redirect::to('admin/posts');
    }

}