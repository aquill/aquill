<?php

$options = array();

foreach (Session::get('install.metadata') as $key => $value) {
    $options[] = array('key' => 'site_'.$key, 'value' => $value);
}

foreach (Session::get('install.rewrites') as $key => $value) {
    $options[] = array('key' => 'rewrite_'.$key, 'value' => $value);
}

return array(

    'options' => $options,

    'users' => array(
            'username' => Session::get('install.account.username', 'admin'),
            'nicename' => Session::get('install.account.username', 'Admin'),
            'password' => Hash::make(Session::get('install.account.password', 'admin123')),
            'email' => Session::get('install.account.email', ''),
            'url' => '',
            'registered' => date('Y-m-d H:i:s'),
            'activation_key' => '',
            'status' => 0,
            'role' => 'administrator',
        ),

    'terms' => array(
            'name' => 'Uncategorised',
            'slug' => 'uncategorised',
            'taxonomy' => 'category',
            'description' => 'Ain\'t no category here.',
            'parent' => 0,
            'count' => 1,
        ),

    'relationships' => array(
            'post_id' => 1,
            'term_id' => 1,
        ),

    'comments' => array(
            'post_id'=> 1,
            'name' => 'My Aquill',
            'email' => Session::get('install.account.email', ''),
            'url' => '',
            'ip' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'content' => 'Hi, this is a comment.',
            'karma' => 0,
            'status' => 'approved',
            'agent' => '',
            'parent' => 0,
            'uesr_id' => 0,
        ),

    'posts' => array(

        'post' => array(
            'author'=> 1,
            'title' => 'Hello World',
            'slug' => 'hello-world',
            'content' => "Hello World!\r\n\r\nThis is the first post.",
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
            'author'=> 1,
            'title' => 'Sample Page',
            'slug' => 'sample-page',
            'content' => "This is an example page.",
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
            'author'=> 1,
            'title' => 'Home',
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
            'author'=> 1,
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
            'author'=> 1,
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