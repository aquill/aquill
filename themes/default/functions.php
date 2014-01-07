<?php

add_filter('post_content', 'autop', 10, 3);

add_filter('page_content', 'autop', 10, 3);

add_filter('comment_content', 'autop', 10, 3);

add_theme_asset('header', 'style', 'themes/default/style.css');

function rss_menu($menus) {
    $menu = new Menu;
    $menu->title = 'Rss';
    $menu->uri = url('feed');
    $menus[] = $menu;

    return $menus;
}

add_filter('site_menu_list', 'rss_menu');