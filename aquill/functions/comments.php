<?php

function comments_open() {
    return Registry::prop('post', 'comment_status');
}

function comment_id() {
    return Registry::prop('comment', 'id');
}

function comment_author() {
    if (comment_author_url()) {
        $author = sprintf('<a class="comment-author" href="%s">%s</a>',
            comment_author_url(),
            comment_author_name());
    } else {
        $author = sprintf('<span class="comment-author">%s</span>',
            comment_author_name());
    }

    return apply_filters('comment_author', $author);
}

function comment_author_name() {
    return Registry::prop('comment', 'name');
}

function comment_author_email() {
    return Registry::prop('comment', 'email');
}

function comment_author_url() {
    return Registry::prop('comment', 'url');
}

function comment_avatar_avatar() {
    return Registry::prop('comment', 'avatar');
}

function comment_date($format = 'Y-m-d H:i:s') {
    return apply_filters('comment_date', Registry::prop('comment', 'date', $format));
}

function comment_content() {
    return apply_filters('comment_content', Registry::prop('comment', 'content'));
}

function comment_message() {
    return Notify::read();
}

function comment_text() {
    return Registry::prop('comment', 'content');
}

function comment_paging() {}

function comment_parent() {}

function comment_list() {}

function get_comments() {
    return Registry::get('comments');
}

function has_comments() {
    $comments = Registry::prop('post', 'comments');

    Registry::set('comments', $comments->results);
    Registry::set('comment_paging', $comments->links());

    return count(Registry::get('comments'));
}

function comment_post_input() {
    return '<input type="hidden" name="post_id" value="'.post_id().'">';
}

function comment_name_input() {
    $name = '';
    
    if ($comment = Cookie::get('comment'))
        $name = $comment['name'];
    
    if ($comment = Session::get('comment'))
        $name = $comment['name'];
    
    return '<input type="text" name="name" value="'.$name.'">';
}

function comment_email_input() {
    $email = '';
    
    if ($comment = Cookie::get('comment'))
        $email = $comment['email'];
    
    if ($comment = Session::get('comment'))
        $email = $comment['email'];
    
    return '<input type="text" name="email" value="'.$email.'">';
}

function comment_url_input() {
    $url = '';
    
    if ($comment = Cookie::get('comment'))
        $url = $comment['url'];
    
    if ($comment = Session::get('comment'))
        $url = $comment['url'];
    
    return '<input type="text" name="url" value="'.$url.'">';
}

function comment_content_input() {
    $content = '';

    if ($comment = Session::get('comment'))
        $content = $comment['content'];
    
    return '<textarea name="content" id="content" cols="30" rows="10">'.$content.'</textarea>';
}

function the_comment() {
    $comments = Registry::get('comments');
    $comment = array_shift($comments);

    Registry::set('comments', $comments);
    Registry::set('comment', $comment);
}