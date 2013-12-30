<?php

function get_categories() {
    return Registry::get('categories');
}

function has_categories() {
    $categories = Registry::prop('post', 'categories');
    Registry::set('categories', $categories);

    return count($categories);
}

function category_description() {
    return Registry::prop('category', 'description');
}

function category_id() {
    return Registry::prop('category', 'id');
}

function category_link() {
    return Registry::prop('category', 'link');
}

function category_list() {
    $output = '<ul>';
    while (categories()) {
        the_category();
        $output .= sprintf('<li><a class="category" href="%s">%s</a></li>',
            category_link(),
            category_name());
    }
    $output .= '</ul>';
    return $output;
}

function category_name() {
    return Registry::prop('category', 'name');
}

function category_slug() {
    return Registry::prop('category', 'slug');
}

function the_category() {
    $categories = Registry::get('categories');
    $category = array_shift($categories);

    Registry::set('categories', $categories);
    Registry::set('category', $category);
}