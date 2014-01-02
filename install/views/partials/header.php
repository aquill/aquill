<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <title><?php _ei('install.title'); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?php echo Asset::container('header')->styles(); ?>
    <script type="text/javascript">var base = "<?php echo url('admin') . '/'; ?>";</script>
    <?php echo Asset::container('header')->scripts(); ?></head>
    
<body>
<div id="sidebar" class="sidebar">

    <nav>
        <ul>
            <li class="start database metadata rewrite account complete"><?php _ei('install.start'); ?></li>
            <li class="database metadata rewrite account complete"><?php _ei('install.database'); ?></li>
            <li class="metadata rewrite account complete"><?php _ei('install.metadata'); ?></li>
            <li class="rewrite account complete"><?php _ei('install.rewrite'); ?></li>
            <li class="account complete"><?php _ei('install.account'); ?></li>
            <li class="complete"><?php _ei('install.all_done'); ?></li>
        </ul>
    </nav>
</div>
<div id="main" class="container">
    <div class="wrap">
<script>
        (function (w, d, u) {
            var parts = "<?php echo URL::current(); ?>".split('/'), url = parts.pop(), li = d.getElementsByClassName(url);
            if (url == 'complete') d.body.parentNode.className += 'small';
            for (var i = 0; i < li.length; i++) li[i].className += ' elapsed';
        }(window, document));
    </script>