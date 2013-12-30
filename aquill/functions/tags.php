<?php

function get_tags() {
    return apply_filters('get_tags', Registry::get('tags'));
}

function has_tags() {
    $tags = Registry::prop('post', 'tags');
    Registry::set('tags', $tags);

    return count($tags);
}

function tag_description() {
    return apply_filters('tag_description', Registry::prop('tag', 'description'));
}

function tag_id() {
    return Registry::prop('tag', 'id');
}

function tag_link() {
    return Registry::prop('tag', 'link');
}

function tag_list() {
    $output = '<ul>';
    while (tags()) {
        the_tag();
        $output .= sprintf('<li><a class="tag" href="%s">%s</a></li>',
            tag_link(),
            tag_name());
    }
    $output .= '</ul>';
    return $output;
}

function tag_name() {
    return apply_filters('tag_name', Registry::prop('tag', 'name'));
}

function tag_slug() {
    return apply_filters('tag_slug', Registry::prop('tag', 'slug'));
}

function the_tag() {
    $tags = Registry::get('tags');
    $tag = array_shift($tags);

    Registry::set('tags', $tags);
    Registry::set('tag', $tag);
}