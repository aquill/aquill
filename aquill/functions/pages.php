<?php

function get_pages() {
    return Registry::get('pages');
}

function page_id() {
    return Registry::prop('page', 'id');
}

function page_link() {
    return Registry::prop('page', 'link');
}

function page_content() {
    return apply_filters('page_content', Registry::prop('page', 'content'));
}

function page_title() {
    return Registry::prop('page', 'title');
}

function the_page() {
    $pages = Registry::get('pages');
    $page = array_shift($pages);

    Registry::set('pages', $pages);
    Registry::set('page', $page);
}