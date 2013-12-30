<?php

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your applications using Laravel's RESTful routing, and it
| is perfectly suited for building both large applications and simple APIs.
| Enjoy the fresh air and simplicity of the framework.
|
*/

Route::get('/, home', function () {

    $vars['posts'] = Post::order_by('created', 'desc')->take(20)->get();

    return new Theme('index');
});

Route::get('(:all).html', function ($slug) {
    $page = Page::find_by_slug($slug);

    if (is_null($page))
        return Response::make(Theme::make('404'), 404);

    var_dump($page);

    return new Theme('page');
});

Route::get(rewrite_rule(), function ($id) {

    if (rule_by_id()) {
        $post = Post::find($id);
    } else {
        $post = Post::find_by_slug($id);
    }

    if (is_null($post))
        Response::make(Theme::make('404'), 404);

    $comments = $post->comments()->get();

    foreach ($comments as $comment) {
        var_dump($comment->plink());
    }

    $tags = $post->tags()->get();

    foreach ($tags as $tag) {
        var_dump($tag->name);
    }

    return new Theme('post');
});

Route::get(rewrite_rule('page'), function ($id) {

    if (rule_by_id('page')) {
        $page = Page::find($id);
    } else {
        $page = Page::find_by_slug($id);
    }

    if (is_null($page))
        Response::make(Theme::make('404'), 404);

    var_dump($page);

    return new Theme('page');
});
/*
Route::get(rewrite_rule('category'), function ($id) {

    if (rule_by_id('page')) {
        $category = Category::find($id);
    } else {
        $category = Category::find_by_slug($id);
    }

    if (is_null($page))
        Response::make(Theme::make('404'), 404);

    var_dump($page);

    return new Theme('category');
});

Route::get(rewrite_rule('tag'), function ($id) {

    if (rule_by_id('page')) {
        $page = Tag::find($id);
    } else {
        $page = Tag::find_by_slug($id);
    }

    if (is_null($page))
        Response::make(Theme::make('404'), 404);

    var_dump($page);

    return new Theme('tag');
});
*/
Route::get('robots.txt', function () {
    $vars['site_url'] = URL::base();

    $content = View::make('robots', $vars);
    $status = 200;
    $headers = array('Content-Type' => 'text/plain');

    return Response::make($content, $status, $headers);
});

Route::get('(feed|rss|atom)', function ($uri) {

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
            $post->url(),
            date('D, d M Y H:i:s O', strtotime($post->created)),
            strip_tags($post->html),
            $post->html
        );
    }

    return $feed->render($uri);
});

Route::get('sitemap.(:any)', function ($suffix = 'xml') {

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
        $sitemap->add($post->url(), date('Y-m-d\TH:i:sP', strtotime($post->created)));
    }

    return $sitemap->render($suffix);
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function () {
    return Response::error(404);
});

Event::listen('500', function () {
    return Response::error(500);
});