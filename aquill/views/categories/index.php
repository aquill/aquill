<?php partial('partials/header'); ?>

    <div id="sidebar" class="sidebar">

        <?php partial('partials/search', array('type' => 'category')); ?>

        <aside id="statuses" class="widget widget-statuses">
            <h3 class="icon-select"><?php _e('category.categories'); ?></h3>
            <ul>
                <li><?php _e('category.categories'); ?></li>
                <li><?php _e('category.tags'); ?></li>
            </ul>
        </aside>

        <aside id="categorylist" class="widget widget-list">
            <h3 class="widget-title">All Categories</h3>
            <ul class="list">
                <?php partial('categories/categories', array('categories' => $categories)); ?>

                <?php if ($categories->total > 20): ?>
                    <li class="load-more" type="categories" page-num="2"><span>Load more categories</span></li>
                <?php endif; ?>
            </ul>
            <?php //echo $categories->links(); ?>
        </aside>
    </div>

    <div id="main" class="container">
        <?php echo $messages; ?>
        <?php echo $formdata; ?>
    </div>

<?php partial('partials/footer'); ?>