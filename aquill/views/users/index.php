<?php admin_include('header'); ?>

    <div id="sidebar" class="sidebar">

        <?php admin_include('search'); ?>

        <aside id="userlist" class="widget widget-list">
            <h3 class="widget-title">All Users</h3>
            <ul class="list">
                <?php foreach ($users->results as $user) : ?>
                    <li class="post" id="user-<?php echo $user->id; ?>">
                        <a <?php echo Input::get('id', 0) == $user->id ? 'class="active"' : ''; ?>
                            href="<?php echo url('admin/users?id=' . $user->id); ?>">
                            <strong><?php echo $user->real_name; ?></strong>
                            <time><?php echo 'Username:' . $user->username; ?></time>
                        </a>
                        <em class="status"><?php echo $user->role; ?></em>
                        <ul class="statuses">
                            <li>Administrator</li>
                            <li>Editor</li>
                            <li>User</li>
                            <li><a class="delete" href="<?php echo url('admin/user/'. $user->id); ?>">Delete</a></li>
                        </ul>
                    </li>
                <?php endforeach; ?>
                <?php if (User::count() > 20): ?>
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

<?php admin_include('footer'); ?>