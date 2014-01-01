<?php partial('partials/header'); ?>

    <div id="sidebar" class="sidebar">

        <?php partial('partials/search', array('type' => 'user')); ?>

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
        <?php echo $messages; ?>
        <?php echo $formdata; ?>
    </div>

<?php partial('partials/footer'); ?>