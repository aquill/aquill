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
<?php endforeach; die(); ?>