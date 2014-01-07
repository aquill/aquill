<?php

Route::get('admin/migrations', function () {
    $vars['messages'] = Notify::read();

    $vars['collations'] = array(
        'utf8_bin' => 'Unicode (multilingual), Binary',
        'utf8_czech_ci' => 'Czech, case-insensitive',
        'utf8_danish_ci' => 'Danish, case-insensitive',
        'utf8_esperanto_ci' => 'Esperanto, case-insensitive',
        'utf8_estonian_ci' => 'Estonian, case-insensitive',
        'utf8_general_ci' => 'Unicode (multilingual), case-insensitive',
        'utf8_hungarian_ci' => 'Hungarian, case-insensitive',
        'utf8_icelandic_ci' => 'Icelandic, case-insensitive',
        'utf8_latvian_ci' => 'Latvian, case-insensitive',
        'utf8_lithuanian_ci' => 'Lithuanian, case-insensitive',
        'utf8_persian_ci' => 'Persian, case-insensitive',
        'utf8_polish_ci' => 'Polish, case-insensitive',
        'utf8_roman_ci' => 'West European, case-insensitive',
        'utf8_romanian_ci' => 'Romanian, case-insensitive',
        'utf8_slovak_ci' => 'Slovak, case-insensitive',
        'utf8_slovenian_ci' => 'Slovenian, case-insensitive',
        'utf8_spanish2_ci' => 'Traditional Spanish, case-insensitive',
        'utf8_spanish_ci' => 'Spanish, case-insensitive',
        'utf8_swedish_ci' => 'Swedish, case-insensitive',
        'utf8_turkish_ci' => 'Turkish, case-insensitive',
        'utf8_unicode_ci' => 'Unicode (multilingual), case-insensitive'
    );

    $database = array(
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'aquill',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => 'aquill_',
    );

    if ($temp = Session::get('migrations.database')) {
        $vars = array_merge($vars, $temp);
    } else {
        $vars = array_merge($vars, $database);
    }
    return View::make('migrations::database', $vars);
});

Route::post('admin/migrations', function () {
    $database = Input::only(array('blog', 'driver', 'host', 'port', 'username', 'password', 'database', 'charset', 'prefix'));

    Config::set('database.default', $database['driver']);
    Config::set('database.connections.' . $database['driver'], $database);

    try {
        DB::connection()->first('select now()');
    } catch (Exception $e) {
        Notify::error($e->getMessage());
        return Redirect::to('admin/migrations');
    }

    Session::put('migrations.database', $database);

    return Redirect::to('admin/migrations/' . $database['blog']);
});

Route::get('admin/migrations/wordpress', function () {
    var_dump(Session::get('migrations'));
});

Route::get('wp2aquill', function () {

    $database1 = 'aquill';
    $prefix1 = 'aquill_';
    $database2 = 'arain';
    $prefix2 = 'wp_';

    dd(Hash::make('admin123'));

    $sql_posts = "
        INSERT INTO `{$database1}`.`{$prefix1}posts`(`id`, `author`, `title`, `slug`, `content`, `excerpt`, `status`, `password`, `created_at`, `updated_at`, `parent`, `uri`, `mime`, `type`, `menu_order`, `comment_status`, `comment_count`) 
        SELECT `ID`, `post_author`, `post_title`, `post_name`, `post_content`, `post_excerpt`, 
        CASE 
        WHEN `post_status` = 'auto-draft' THEN 'auto' 
        ELSE `post_status` 
        END AS `post_status`, `post_password`, `post_date`, `post_modified`, `post_parent`, `guid`, `post_mime_type`, 
        CASE 
        WHEN `post_type` = 'nav_menu_item' THEN 'menu' 
        ELSE `post_type` 
        END AS `type`, `menu_order`, `comment_status`, `comment_count` 
        FROM `{$database2}`.`{$prefix2}posts`
    ";

    $sql_terms = "
        INSERT INTO `{$database1}`.`{$prefix1}terms`(`id`, `name`, `slug`, `taxonomy`, `description`, `parent`, `count`)
        SELECT `{$prefix2}terms`.`term_id`, `name`, `slug`, 
        CASE 
        WHEN  `taxonomy` =  'post_tag' THEN  'tag'
        WHEN  `taxonomy` =  'link_category' THEN  'link'
        ELSE  `taxonomy` 
        END AS `taxonomy`, `description`, `parent`, `count` 
        FROM `{$database2}`.`{$prefix2}terms` 
        JOIN `{$database2}`.`{$prefix2}term_taxonomy` 
        ON `{$database2}`.`{$prefix2}terms`.`term_id` = `{$database2}`.`{$prefix2}term_taxonomy`.`term_id` 
        GROUP BY `{$database2}`.`{$prefix2}terms`.`term_id`
    ";

    $sql_relationships = "
        INSERT INTO `{$database1}`.`{$prefix1}relationships`(`post_id`, `term_id`) 
        SELECT `object_id`, `term_taxonomy_id` 
        FROM `{$database2}`.`{$prefix2}term_relationships`
    ";

    $sql_comments = "
        INSERT INTO `{$database1}`.`{$prefix1}comments`(`id`, `post_id`, `name`, `email`, `url`, `ip`, `created_at`, `content`, `karma`, `status`, `agent`, `parent`, `uesr_id`)
        SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_content`, `comment_karma`, 
        CASE 
        WHEN  `comment_approved` =  '1' THEN  'approved'
        ELSE  `comment_approved` 
        END AS `comment_approved`, `comment_agent`, `comment_parent`, `user_id` 
        FROM `{$database2}`.`{$prefix2}comments`
    ";

    $sql_users = "
        INSERT INTO `{$database1}`.`{$prefix1}users`(`id`, `username`, `password`, `nicename`, `email`, `url`, `registered`, `activation_key`, `status`, `role`)
        SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, 'administrator' 
        FROM `{$database2}`.`{$prefix2}users`
    ";

    DB::connection()->query("TRUNCATE TABLE  `{$prefix1}comments`");
    DB::connection()->query("TRUNCATE TABLE  `{$prefix1}terms`");
    DB::connection()->query("TRUNCATE TABLE  `{$prefix1}relationships`");
    DB::connection()->query("TRUNCATE TABLE  `{$prefix1}posts`");

    DB::connection()->query($sql_posts);
    DB::connection()->query($sql_terms);
    DB::connection()->query($sql_relationships);
    DB::connection()->query($sql_comments);

    echo exec_time();
});

