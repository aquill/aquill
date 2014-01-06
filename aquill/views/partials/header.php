<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <?php echo Asset::container('header')->styles(); ?>
    <script type="text/javascript">var base = "<?php echo url('admin') . '/'; ?>";</script>
    <?php echo Asset::container('header')->scripts(); ?>
</head>
<body <?php echo admin_body_class('admin'); ?>>
<div id="header" class="col toolbar">
    <ul class="site-navigation">
        <?php $menu = array('dashboard', 'posts', 'comments', 'tags', 'users', 'themes');
        foreach ($menu as $item) : ?>
            <li <?php echo uri_has($item) ? 'class="active" ' : ' '; ?>>
                <a class="icon-<?php echo $item; ?>" title="<?php _e('dashboard.'.$item); ?>" href="<?php echo url('admin/'.$item); ?>"></a>
            </li>
        <?php endforeach; ?>        
        <li>
            <a class="icon-undo" title="Visit your site" target="_blank" href="<?php echo url('/') ?>"></a>
        </li>
        <li class="bottom">
            <a class="icon-logout" title="Logout" href="<?php echo url('logout'); ?>"></a>
        </li>
    </ul>
</div>