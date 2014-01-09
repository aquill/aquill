<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo site_head_title(); ?></title>
    <?php echo theme_styles(); ?>
    <link rel="icon" href="<?php echo asset('assets/favicon.png'); ?>" sizes="32x32" type="image/png">
</head>

<body <?php echo body_class(); ?>>
    
    <div id="sidebar" class="sidebar">
        <hgroup>
            <h1 id="site-title"><a href="<?php echo url(); ?>"><?php echo site_title(); ?></a></h1>
            <h2 id="site-description"><?php echo site_description(); ?></h2>
        </hgroup>

        <ul id="site-menu">
            <?php echo site_menu_list(); ?>
        </ul>
    </div>

    <div id="main" class="container">