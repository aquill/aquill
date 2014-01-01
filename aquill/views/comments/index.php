<?php partial('partials/header'); ?>

    <div id="sidebar" class="sidebar">

        <?php partial('partials/search', array('type' => 'comment')); ?>

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
        <?php echo $messages; ?>
        <?php echo $formdata; ?>
    </div>

<?php partial('partials/footer'); ?>