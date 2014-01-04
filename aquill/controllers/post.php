<?php

class PostController extends AdminController
{
    
    public function index($id = null) {
        $vars['messages'] = Notify::read();
        $vars['posts'] = Post::where_in('status', array('publish', 'draft'))
                            ->where('type', '=', 'post')
                            ->order_by('created_at', 'DESC')
                            ->paginate(10);

        $data['statuses'] = array(
            'publish' => __('post.publish'),
            'draft' => __('post.draft')
        );
        
        $vars['categories'] = $data['categories'] = Category::titles();

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
        $vars['posts'] = Post::where('status', '=', 'publish')
                            ->or_where('status', '=', 'draft')
                            ->order_by('created_at', 'DESC')
                            ->paginate(10);

        return View::make('posts/posts', $vars);
    }

    public function compose($id = null) {
        $start = microtime(true);
        $input = Input::only(array('title', 'slug', 'created_at',
            'content', 'status', 'expect'));

        $input['comment_status'] = Input::get('comment_status', 0);

        if (empty($input['slug'])) {
            $input['slug'] = urlencode($input['title']);
        } else {
            $input['slug'] = urlencode($input['slug']);
        }

        $rules = array(
            'title' => 'required',
            'slug' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->valid()) {
            $id = Post::save($input);
            $time = number_format((microtime(true) - $start) * 1000, 2);
            Notify::success('post created time: ' . $time);
        }

        return Redirect::to('admin/posts/' . $id);
    }

    public function delete($id) {
        if (!is_null($id)) Post::delete($id);

        return Redirect::to('admin/posts');
    }

}