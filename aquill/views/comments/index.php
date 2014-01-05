<?php partial('partials/header'); ?>

    <div id="sidebar" class="sidebar">

        <?php partial('partials/search', array('type' => 'comment')); ?>

        <aside id="statuses" class="widget widget-statuses">
            <h3 class="icon-select"><?php _e('comment.comments'); ?></h3>
            <ul>
                <?php foreach ($statuses as $key => $type) : ?>
                    <li><?php echo $type; ?></li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <aside id="commentlist" class="widget widget-list">
            <h3 class="widget-title">All Comments</h3>
            <ul class="list">
                <?php partial('comments/comments', array('comments' => $comments)); ?>
                
                <?php if ($comments->total > 20): ?>
                    <li class="load-more" type="comments" page-num="2"><span>Load more comments</span></li>
                <?php endif; ?>
            </ul>
            <?php //echo $comments->links(); ?>
        </aside>
    </div>

    <div id="main" class="container">
        <?php echo $formdata; ?>
    </div>

<?php partial('partials/footer'); ?>