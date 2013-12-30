<?php

function comments_open() {
    return Registry::prop('post', 'comment_status');
}

function comment_id() {
    return Registry::prop('comment', 'id');
}

function comment_author() {
    return sprintf('<a class="comment-author" href="%s">%s</a>',
        comment_author_url(),
        comment_author_name());
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

function comment_date() {
    return Registry::prop('comment', 'date');
}

function comment_content() {
    return markdown(Registry::prop('comment', 'text'));
}

function comment_text() {
    return Registry::prop('comment', 'text');
}

function comment_paging() {}

function comment_parent() {}

function comment_list() {}

function get_comments() {
    return Registry::get('comments');
}

function has_comments() {
    $comments = Registry::prop('post', 'comments');

    Registry::set('comments', $comments);

    return count($comments);
}

function the_comment() {
    $comments = Registry::get('comments');
    $comment = array_shift($comments);

    Registry::set('comments', $comments);
    Registry::set('comment', $comment);
}