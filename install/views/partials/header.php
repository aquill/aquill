<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <title><?php _et('install.title'); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?php echo Asset::container('header')->styles(); ?>
    <script type="text/javascript">var base = "<?php echo url('admin') . '/'; ?>";</script>
    <?php echo Asset::container('header')->scripts(); ?></head>
    
<body class="install <?php echo session::get('current.color', 'purple'); ?>">
<div id="sidebar" class="sidebar">

    <nav>
        <ul>
            <?php site_menu_list() ?>
        </ul>
    </nav>
</div>
<div id="main" class="container">
    <div class="wrap">