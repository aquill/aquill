<?php

class SiteController extends Controller
{

    public function home() {
        $posts = Post::order_by('created', 'DESC')->paginate(10);

        Registry::set('posts', $posts->results);
        Registry::set('posts_paging', $posts->links());

        return new Theme('index');
    }

    public function post($id) {

        if (get_by_id()) {
            $post = Post::find($id);
        } else {
            $post = Post::find_by_slug($id);
        }

        if (is_null($post))
            Response::make(Theme::make('404'), 404);

        Registry::set('post', $post);

        return new Theme('post');
    }

    public function page($id) {

        if (get_by_id('page')) {
            $page = Page::find($id);
        } else {
            $page = Page::find_by_slug($id);
        }

        if (is_null($page))
            Response::make(Theme::make('404'), 404);

        var_dump($page);

        return new Theme('page');
    }

    public function category($id) {
        if (get_by_id('category')) {
            $category = Category::find($id);
        } else {
            $category = Category::find_by_slug($id);
        }

        if (is_null($category))
            Response::make(Theme::make('404'), 404);

        $posts = $category->posts();

        Registry::set('posts', $posts->results);
        Registry::set('posts_paging', $posts->links());

        return new Theme('index');
    }

    public function tag($id) {
        if (get_by_id('tag')) {
            $tag = Tag::find($id);
        } else {
            $tag = Tag::find_by_slug($id);
        }

        if (is_null($tag))
            Response::make(Theme::make('404'), 404);

        $posts = $tag->posts();

        Registry::set('posts', $posts->results);
        Registry::set('posts_paging', $posts->links());

        return new Theme('index');
    }

    public function author($id) {
        if (get_by_id('author')) {
            $author = User::find($id);
        } else {
            $author = User::find_by_username($id);
        }

        if (is_null($author))
            Response::make(Theme::make('404'), 404);

        $posts = $author->posts();

        Registry::set('posts', $posts->results);
        Registry::set('posts_paging', $posts->links());

        return new Theme('index');
    }

    public function comment() {
        $comment = Input::only(array('post_id', 'name', 'email', 'url', 'content'));
        $post = Post::find($comment['post_id']);

        $validation = Validator::make($comment, Comment::$rules);

        if ($validation->invalid()) {
            //Comment::update($id, $input);
            Session::put('comment', $comment);
            Notify::error('Publish comment error.');
            return Redirect::to($post->link() . '#response');
        }

        Session::forget('comment');

        return Redirect::to($post->link() . '#comment');
    }

    public function robots() {
        $vars['site_url'] = URL::base();

        $content = View::make('robots', $vars);
        $status = 200;
        $headers = array('Content-Type' => 'text/plain');

        return Response::make($content, $status, $headers);
    }

    public function feed($uri) {
        $posts = Post::order_by('created', 'desc')->take(20)->get();

        $feed = new Feed();

        $feed->title = 'Your title';
        $feed->description = 'Your description';
        $feed->link = url('feed');
        $feed->pubdate = date('D, d M Y H:i:s O', strtotime(current($posts)->created));
        $feed->lang = 'en';

        foreach ($posts as $post) {
            // set item's title, author, url, pubdate and description
            $feed->add(
                $post->title,
                $post->author_name(),
                $post->link(),
                date('D, d M Y H:i:s O', strtotime($post->created)),
                strip_tags($post->html),
                $post->html
            );
        }

        return $feed->render($uri);
    }

    public function sitemap($suffix = 'xml') {

        $suffixes = array('xml', 'html', 'ror.rdf', 'ror.rss', 'txt');

        if (!in_array($suffix, $suffixes))
            return Response::make(Theme::make('404'), 404);

        $sitemap = new Sitemap();

        $sitemap->title = 'Aquill';

        $posts = Post::order_by('created', 'desc')->get();

        $post = array_slice($posts, 0, 1);

        $lastmod = date('Y-m-d\TH:i:sP', strtotime($post[0]->created));

        $sitemap->add(url(), $lastmod, '1.0', 'daily');

        foreach ($posts as $post) {
            $sitemap->add($post->link(), date('Y-m-d\TH:i:sP', strtotime($post->created)));
        }

        return $sitemap->render($suffix);
    }

}