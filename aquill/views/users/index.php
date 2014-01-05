<?php partial('partials/header'); ?>

    <div id="sidebar" class="sidebar">

        <?php partial('partials/search', array('type' => 'user')); ?>

        <aside id="statuses" class="widget widget-statuses">
            <h3 class="icon-select"><?php _e('user.users'); ?></h3>
            <ul>
                
                <?php foreach ($roles as $key => $role) : ?>
                    <li><?php echo $role; ?></li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <aside id="userlist" class="widget widget-list">
            <h3 class="widget-title">All Users</h3>
            <ul class="list">

                <?php partial('users/users', array('users' => $users)); ?>

                <?php if ($users->total > 20): ?>
                    <li class="load-more" type="users" page-num="2"><span>Load more users</span></li>
                <?php endif; ?>
            </ul>

            <?php //echo $users->links(); ?>
        </aside>
    </div>

    <div id="main" class="container">
        <?php echo $formdata; ?>
    </div>

<?php partial('partials/footer'); ?>