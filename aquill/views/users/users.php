<?php foreach ($users->results as $user) : ?>
    <li class="post" id="user-<?php echo $user->id; ?>">
        <a <?php echo Input::get('id', 0) == $user->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/users?id=' . $user->id); ?>">
            <strong><?php echo $user->nicename; ?></strong>
            <time><?php echo 'Username:' . $user->username; ?></time>
        </a>
        <em class="status"><?php _e('user.' . $user->role); ?></em>
        <ul class="statuses">
            <li><?php _e('user.administrator'); ?></li>
            <li><?php _e('user.editor'); ?></li>
            <li><?php _e('user.author'); ?></li>
            <li><?php _e('user.pending'); ?></li>
            <li><a class="delete"
                   href="<?php echo url('admin/user/' . $user->id); ?>"><?php _e('user.delete'); ?></a></li>
        </ul>
    </li>
<?php endforeach; ?>