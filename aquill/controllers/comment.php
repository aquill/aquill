<?php

class CommentController extends AdminController
{

    public function index($id = null) {
        $vars['comments'] = Comment::order_by('created_at', 'DESC')->paginate(10);

        $data['messages'] = Notify::read();

        if ($id = Input::get('id', 0)) {
            $data['comment'] = Comment::find($id);
        } else {
            $data['comment'] = new Comment;
        }

        $vars['statuses'] = $data['statuses'] = array(
            'approved' => __('comment.Approved'),
            'pending' => __('comment.Pending'),
            'spam' => __('comment.Spam')
        );

        return View::make('comments/index', $vars)->nest('formdata', 'comments/form', $data);
    }

    public function paginate() {
        if (Input::get('page') > Comment::count() / 20) {
            return;
        }

        $vars['comments'] = Comment::order_by('created_at', 'DESC')->paginate(20);

        return View::make('comments/comments', $vars);
    }

    public function update($id = null) {
        $start = microtime(true);

        if (is_null($id)) return Redirect::to('admin/comments');

        $input = Input::only(array('name', 'email', 'url', 'content', 'status'));

        $validation = Validator::make($input, Comment::$rules);

        if ($validation->invalid()) {
            Notify::success('error.');
            return Redirect::to("admin/comments?id={$id}");
        }

        Comment::push($input);
        $time = number_format((microtime(true) - $start) * 1000, 2);
        Notify::success('comment updated time: ' . $time);

        return Redirect::to("admin/comments?id={$id}");
    }
}