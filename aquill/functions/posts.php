<?php

function get_posts() {
    return Registry::get('posts');
}

function has_posts() {
    return count(Registry::get('posts'));
}

function post_id() {
    return Registry::prop('post', 'id');
}

function post_title() {
    return Registry::prop('post', 'title');
}

function post_date() {
    return Registry::prop('post', 'created');
}

function post_content() {
    return markdown(Registry::prop('post', 'html'));
}

function post_excerpt() {
    return Registry::prop('post', 'html');
}

function post_text() {
    return Registry::prop('post', 'html');
}

function post_link() {
    return Registry::prop('post', 'link');
}

function post_prev() {
    return Registry::prop('post', 'prev');
}

function post_next() {
    return Registry::prop('post', 'next');
}

function posts_paging() {
    return Registry::get('posts_paging');
}

function the_post() {
    $posts = Registry::get('posts');
    $post = array_shift($posts);

    Registry::set('posts', $posts);
    Registry::set('post', $post);
}