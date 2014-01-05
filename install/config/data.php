<?php

$options = array();

foreach (Session::get('install.metadata') as $name => $value) {
    $options[] = array('name' => 'site_' . $name, 'value' => $value);
}

foreach (Session::get('install.rewrites') as $name => $value) {
    $options[] = array('name' => 'rewrite_' . $name, 'value' => $value);
}

return array(

    'options' => $options,

    'users' => array(
        'username' => Session::get('install.account.username', 'admin'),
        'nicename' => Session::get('install.account.username', 'Admin'),
        'password' => Hash::make(Session::get('install.account.password', 'admin123')),
        'email' => Session::get('install.account.email', ''),
        'url' => '',
        'bio' => '',
        'registered' => date('Y-m-d H:i:s'),
        'activation_key' => '',
        'role' => 'administrator',
    ),

    'terms' => array(
        'name' => _t('data.category_name'),
        'slug' => 'uncategorised',
        'taxonomy' => 'category',
        'description' => _t('data.category_description'),
        'parent' => 0,
        'count' => 1,
    ),

    'relationships' => array(
        'post_id' => 1,
        'term_id' => 1,
    ),

    'comments' => array(
        'post_id' => 1,
        'name' => _t('data.comment_name'),
        'email' => Session::get('install.account.email', ''),
        'url' => 'http://aquill.org/',
        'ip' => '',
        'created_at' => date('Y-m-d H:i:s'),
        'content' => _t('data.comment_content'),
        'karma' => 0,
        'status' => 'approved',
        'agent' => '',
        'parent' => 0,
        'uesr_id' => 0,
    ),

    'posts' => array(

        'post' => array(
            'author' => 1,
            'title' => _t('data.post_title'),
            'slug' => _t('data.post_slug'),
            'content' => _t('data.post_content'),
            'excerpt' => '',
            'status' => 'publish',
            'type' => 'post',
            'password' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'parent' => 0,
            'guid' => '',
            'mime' => '',
            'menu_order' => 0,
            'comment_status' => 1,
            'comment_count' => 1,
        ),

        'page' => array(
            'author' => 1,
            'title' => _t('data.page_title'),
            'slug' => _t('data.page_slug'),
            'content' => _t('data.page_content'),
            'excerpt' => '',
            'status' => 'publish',
            'type' => 'page',
            'password' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'parent' => 0,
            'guid' => '',
            'mime' => '',
            'menu_order' => 0,
            'comment_status' => 1,
            'comment_count' => 1,
        ),

        'menu1' => array(
            'author' => 1,
            'title' => _t('data.menu_home'),
            'slug' => '',
            'content' => '',
            'excerpt' => '',
            'status' => 'publish',
            'type' => 'menu',
            'password' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'parent' => 0,
            'guid' => '',
            'mime' => '',
            'menu_order' => 1,
            'comment_status' => 0,
            'comment_count' => 0,
        ),

        'menu2' => array(
            'author' => 1,
            'title' => '',
            'slug' => 'page-2',
            'content' => '',
            'excerpt' => '',
            'status' => 'publish',
            'type' => 'menu',
            'password' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'parent' => 0,
            'guid' => '',
            'mime' => '',
            'menu_order' => 2,
            'comment_status' => 0,
            'comment_count' => 0,
        ),

        'menu3' => array(
            'author' => 1,
            'title' => '',
            'slug' => 'category-1',
            'content' => '',
            'excerpt' => '',
            'status' => 'publish',
            'type' => 'menu',
            'password' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'parent' => 0,
            'guid' => '',
            'mime' => '',
            'menu_order' => 3,
            'comment_status' => 0,
            'comment_count' => 0,
        )
    ),
);