<?php

function get_tags() {
    return Registry::get('tags');
}

function has_tags() {
    $tags = Registry::prop('post', 'tags');
    Registry::set('tags', $tags);

    return count($tags);
}

function tag_description() {
    return Registry::prop('tag', 'description');
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
    return Registry::prop('tag', 'name');
}

function tag_slug() {
    return Registry::prop('tag', 'slug');
}

function the_tag() {
    $tags = Registry::get('tags');
    $tag = array_shift($tags);

    Registry::set('tags', $tags);
    Registry::set('tag', $tag);
}