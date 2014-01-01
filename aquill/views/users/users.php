<?php foreach ($users->results as $user) : ?>
    <li class="post" id="user-<?php echo $user->id; ?>">
        <a <?php echo Input::get('id', 0) == $user->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/users?id=' . $user->id); ?>">
            <strong><?php echo $user->nicename; ?></strong>
            <time><?php echo 'Username:' . $user->username; ?></time>
        </a>
        <em class="status"><?php echo __('user.' . $user->role); ?></em>
        <ul class="statuses">
            <li><?php echo __('user.administrator'); ?></li>
            <li><?php echo __('user.editor'); ?></li>
            <li><?php echo __('user.author'); ?></li>
            <li><?php echo __('user.pending'); ?></li>
            <li><a class="delete"
                   href="<?php echo url('admin/user/' . $user->id); ?>"><?php echo __('user.delete'); ?></a></li>
        </ul>
    </li>
<?php endforeach; ?>