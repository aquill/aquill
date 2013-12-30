<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <?php echo Asset::container('header')->styles(); ?>
    <script type="text/javascript">var base = "<?php echo url('admin') . '/'; ?>";</script>
    <?php echo Asset::container('header')->scripts(); ?>
</head>
<body <?php echo body_class(); ?>>
<div id="header" class="col toolbar">
    <ul class="site-navigation">
        <li>
            <a class="icon-undo" title="Visit your site" target="_blank" href="<?php echo url('/') ?>"></a>
        </li>
        <li <?php echo uri_has('posts') ? 'class="active" ' : ' '; ?>>
            <a class="icon-posts" href="<?php echo url('admin/posts'); ?>" title="Posts.posts"></a>
        </li>
        <li <?php echo uri_has('comments') ? 'class="active" ' : ' '; ?>>
            <a class="icon-comments" href="<?php echo url('admin/comments'); ?>" title="Comments.comments"></a>
        </li>
        <li <?php echo uri_has('categories') ? 'class="active" ' : ' '; ?>>
            <a class="icon-categories" href="<?php echo url('admin/categories'); ?>" title="Categories.categories"></a>
        </li>
        <li <?php echo uri_has('users') ? 'class="active" ' : ' '; ?>>
            <a class="icon-users" href="<?php echo url('admin/users'); ?>" title="Users.users"></a>
        </li>
        <li <?php echo uri_has('settings') ? 'class="active" ' : ' '; ?>>
            <a class="icon-extend" href="<?php echo url('admin/settings'); ?>" title="Extend.extend"></a>
        </li>
        <li>
            <a class="icon-logout" title="Logout" href="<?php echo url('logout'); ?>"></a>
        </li>
    </ul>
</div>