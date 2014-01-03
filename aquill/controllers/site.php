<?php

class SiteController extends Controller
{

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');

        $menus = Menu::site();
        $pages = Page::published()->get();

        Registry::set('menus', $menus);
        Registry::set('pages', $pages);
    }

    public function home() {
        $homepage = Config::get('rewrite.home');

        $posts = Post::published()->paginate(10);

        Registry::set('posts', $posts);

        if (is_null($homepage)) {

            return new Theme('index');            
        }

        return new Theme($homepage);
    }

    public function feed($uri) {
        $posts = Post::published()->take(20)->get();

        if (empty($posts)) return;

        $feed = new Feed();

        $feed->title = 'Your title';
        $feed->description = 'Your description';
        $feed->link = url('feed');
        $feed->pubdate = current($posts)->date('D, d M Y H:i:s O');
        $feed->lang = 'en';

        foreach ($posts as $post) {
            $feed->add(
                $post->title,
                $post->author_name(),
                $post->link(),
                $post->date('D, d M Y H:i:s O'),
                strip_tags($post->content),
                autop($post->content)
            );
        }

        return $feed->render($uri);
    }

    public function sitemap($suffix = 'xml') {

        $suffixes = array('xml', 'html', 'ror.rdf', 'ror.rss', 'txt');

        if (!in_array($suffix, $suffixes))
            return Theme::notFound();

        $posts = Post::published()->get();
        
        if (empty($posts)) return;

        $sitemap = new Sitemap();

        $sitemap->title = 'Aquill';

        $lastmod = current($posts)->date('Y-m-d\TH:i:sP');

        $sitemap->add(url(), $lastmod, '0.9', 'daily');

        foreach ($posts as $post) {
            $sitemap->add($post->link(), $post->date('Y-m-d\TH:i:sP'));
        }

        return $sitemap->render($suffix);
    }

    public function robots() {
        $vars['site_url'] = URL::base();

        $content = View::make('robots', $vars);
        $status = 200;
        $headers = array('Content-Type' => 'text/plain');

        return Response::make($content, $status, $headers);
    }

    public function post($id) {

        if (get_by_id()) {
            $post = Post::find($id);
        } else {
            $post = Post::find_by_slug($id);
        }

        if (is_null($post))
            return Theme::notFound();

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
            return Theme::notFound();
        
        Registry::set('page', $page);

        return new Theme('page');
    }

    public function category($id) {
        if (get_by_id('category')) {
            $category = Category::find($id);
        } else {
            $category = Category::find_by_slug($id);
        }

        if (is_null($category))
            return Theme::notFound();

        $posts = $category->posts();

        Registry::set('category', $category);
        Registry::set('posts', $posts);

        return new Theme('index');
    }

    public function tag($id) {
        if (get_by_id('tag')) {
            $tag = Tag::find($id);
        } else {
            $tag = Tag::find_by_slug($id);
        }

        if (is_null($tag))
            return Theme::notFound();

        $posts = $tag->posts();

        Registry::set('tag', $tag);
        Registry::set('posts', $posts);

        return new Theme('index');
    }

    public function author($id) {
        if (get_by_id('author')) {
            $author = User::find($id);
        } else {
            $author = User::find_by_username($id);
        }

        if (is_null($author))
            return Theme::notFound();

        $posts = $author->posts();

        Registry::set('author', $author);
        Registry::set('posts', $posts);

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
        
        if (!Cookie::get('comment')) {
            Cookie::forever('comment', $comment);
        }

        Session::forget('comment');

        return Redirect::to($post->link() . '#comment');
    }

}