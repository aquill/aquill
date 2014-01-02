<?php partial('partials/header'); ?>

<div id="sidebar" class="sidebar">

    <?php partial('partials/search', array('type' => 'post')); ?>

    <aside id="postlist" class="widget widget-list">
        <h3 class="widget-title">All posts</h3>
        <ul class="list">
            <?php partial('posts/posts', array('posts' => $posts)); ?>

            <?php if ($posts->total > 10): ?>
                <li class="load-more" type="posts" page-num="2">
                    <span><?php _e('post.load_more'); ?></span>
                </li>
            <?php endif; ?>
        </ul>
        <?php //echo $posts->links(); ?>
    </aside>
</div>

<div id="main" class="container">
    <?php echo $messages; ?>
    <?php echo $formdata; ?>
</div>

<?php partial('partials/footer'); ?>
